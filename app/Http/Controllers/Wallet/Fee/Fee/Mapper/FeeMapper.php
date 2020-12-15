<?php


namespace App\Http\Controllers\Wallet\Fee\Fee\Mapper;


use Illuminate\Http\Request;
use Wallet\Wallet\Fee\Fee\Entity\FeeEntity;
use Wallet\Wallet\Fee\Fee\Entity\FeeEntityInterface;
use Wallet\Wallet\Fee\Fee\Entity\SpecEntity;

class FeeMapper implements FeeMapperInterface
{
    /**
     * @param Request $request
     * @return FeeEntityInterface
     */
    public static function createFeeFromHttpRequest(
        Request $request
    ): FeeEntityInterface
    {
        $payload = $request->json()->all();
        return FeeEntity::fromArray([
                'paymentMean'=> $payload['paymentMean'],
                'regionId' => $payload['regionId'],
                'walletOrganizations'=> $request->get('ApiConsumer')->getOrganizations(),
                'fees'=> $payload['fees']
            ]
        );
    }
}
