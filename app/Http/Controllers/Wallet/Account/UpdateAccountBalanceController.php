<?php


namespace App\Http\Controllers\Wallet\Account;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wallet\Wallet\Account\Entity\TransactionEntityInterface;
use Wallet\Wallet\Account\Service\AccountService;
use Wallet\Wallet\Account\Service\AccountServiceInterface;
use Wallet\Wallet\Account\Entity\TransactionEntity;
use Wallet\Wallet\Account\Service\AccountTransactionService;
use Wallet\Wallet\Account\Service\AccountTransactionServiceInterface;

class UpdateAccountBalanceController  extends Controller
{
    /**
     * @var AccountServiceInterface
     */
    private $accountService;

    /**
     * @var AccountTransactionServiceInterface
     */
    private $accountTransactionService;

    /**
     * UpdateAccountBalanceController constructor.
     * @param AccountServiceInterface $accountService
     * @param AccountTransactionServiceInterface $accountTransactionService
     */
    public function __construct(
        AccountService $accountService,
        AccountTransactionService $accountTransactionService
    ){
        $this->accountService = $accountService;
        $this->accountTransactionService = $accountTransactionService;
    }


    public function topUp(
        $userId,
        $accountId,
        Request $request)
    {
        $accountEntity = $this->accountService->topUp(
            $userId,
            $accountId,
            $request->get('ApiConsumer')->getOrganizations(),
            $request->json()->get('amount')
        );


        $event = $this->accountTransactionService
            ->create(
                new TransactionEntity(
                    TransactionEntityInterface::TRANSACTION_TYPE_CREDIT,
                    $userId,
                    $accountId,
                    $request->json()->get('amount'),
                    $request->json()->get('description'),
                    current($request->get('ApiConsumer')->getOrganizations()),
                    $request->get('ApiConsumer')->getClientId()
                )
            );

        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletAccount' => $accountEntity->toArray(),
                    'TransactionDetails'=>[
                        'transactionId'=> $event->getEventId()
                    ]
                ]
            ]

        );
    }

    public function debit(
        $userId,
        $accountId,
        Request $request)
    {
        if (!$request->get('ApiConsumer')->hasScope('wallet-gateway/DebitAccount')) {
            return response()->json(
                [
                    'status' => 'failure',
                    'statusCode' => 0,
                    'statusDescription' => "You don't seem to have enough permissions to perform this action"
                ],
                401
            );
        }
        $accountEntity = $this->accountService->debit(
            $userId,
            $accountId,
            $request->get('ApiConsumer')->getOrganizations(),
            $request->json()->get('amount')
        );

        $event = $this->accountTransactionService
            ->create(
                new TransactionEntity(
                    TransactionEntityInterface::TRANSACTION_TYPE_DEBIT,
                    $userId,
                    $accountId,
                    -$request->json()->get('amount'),
                    $request->json()->get('description'),
                    current($request->get('ApiConsumer')->getOrganizations()),
                    $request->get('ApiConsumer')->getClientId()
                )
            );

        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletAccount' => $accountEntity->toArray(),
                    'TransactionDetails'=>[
                        'transactionId'=> $event->getEventId()
                    ]
                ]
            ]
        );
    }
}
