<?php


namespace App\Http\Controllers\Wallet\User\PaymentMean\Mapper;


use Illuminate\Http\Request;
use Wallet\Wallet\User\PaymentMean\Entity\PaymentMeanEntity;
use Wallet\Wallet\User\PaymentMean\Entity\PaymentMeanEntityInterface;

class UserPaymentMeanHttpMapper implements UserPaymentMeanHttpMapperInterface
{

    /**
     * @inheritDoc
     */
    public static function createUserPaymentMeanFromHttpRequest(Request $request): PaymentMeanEntityInterface
    {
        return PaymentMeanEntity::fromArray(
            array_merge(
                $request->json()->all(),
                [
                    'organizations' => $request->get('ApiConsumer')->getOrganizations()
                ]
            )
        );
    }
}
