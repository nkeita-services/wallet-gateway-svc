<?php


namespace App\Http\Controllers\Wallet\Account;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wallet\Account\Service\AccountService;
use Wallet\Account\Service\AccountServiceInterface;
use Wallet\Wallet\Event\Entity\EventEntity;
use Wallet\Wallet\Event\Service\EventService;
use Wallet\Wallet\Event\Service\EventServiceInterface;

class UpdateAccountBalanceController  extends Controller
{
    /**
     * @var AccountServiceInterface
     */
    private $accountService;

    /**
     * @var EventServiceInterface
     */
    private $eventService;

    /**
     * UpdateAccountBalanceController constructor.
     * @param AccountServiceInterface $accountService
     * @param EventServiceInterface $eventService
     */
    public function __construct(
        AccountService $accountService,
        EventService $eventService
    ){
        $this->accountService = $accountService;
        $this->eventService = $eventService;
    }


    public function topUp(
        $userId,
        $accountId,
        Request $request)
    {
        if (!$request->get('ApiConsumer')->hasScope('wallet-gateway/TopUpAccount')) {
            return response()->json(
                [
                    'status' => 'failure',
                    'statusCode' => 0,
                    'statusDescription' => "You don't seem to have enough permissions to perform this action"
                ],
                401
            );
        }

        $accountEntity = $this->accountService->topUp(
            $userId,
            $accountId,
            $request->get('ApiConsumer')->getOrganizations(),
            $request->json()->get('amount')
        );

        $this
            ->eventService
            ->create(
                EventEntity::fromArray(
                    [
                        'originator'=> $request->get('ApiConsumer')->getClientId(),
                        'originatorId'=>$accountId,
                        'actions'=>[
                            'AccountBalanceOperation',
                            'AccountOperation'
                        ],
                        'description'=>'Account TopUp',
                        'timestamp'=>time(),
                        'data'=>[
                            'amount' => $request->json()->get('amount')
                        ]
                    ]
                )
            );

        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletAccount' => $accountEntity->toArray()
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

        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletAccount' => $this->accountService->debit(
                        $userId,
                        $accountId,
                        $request->get('ApiConsumer')->getOrganizations(),
                        $request->json()->get('amount')
                    )->toArray()
                ]
            ]

        );
    }
}
