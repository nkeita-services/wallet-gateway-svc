<?php


namespace App\Http\Controllers\Wallet\Fee\Quote\Mapper;


use Illuminate\Http\Request;
use Wallet\Wallet\Fee\Transaction\TransactionEntity;
use Wallet\Wallet\Fee\Transaction\TransactionEntityInterface;

class QuoteFeeMapper
{
    /**
     * @inheritDoc
     */
    public static function createQuoteFeeFromHttpRequest(Request $request): TransactionEntityInterface
    {
        $payload = $request->json()->all();
        return TransactionEntity::fromArray([
                'paymentMean'=> $payload['paymentMean'],
                'amount'=> floatval($payload['amount']),
                'accountId'=> $payload['accountId'],
                'walletOrganizations'=> $request->get('ApiConsumer')->getOrganizations(),
                'regions'=> $payload['regions'],
                'operation'=> $payload['operation'],
                'currency'=> $payload['currency'],
                'originator' =>  $payload['originator']
            ]
        );
    }
}
