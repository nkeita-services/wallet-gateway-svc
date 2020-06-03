<?php


namespace App\Http\Controllers\Wallet\Plan\Mapper;


use Illuminate\Http\Request;
use Wallet\Wallet\Plan\Entity\WalletPlanEntity;
use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;

class WalletPlanMapper implements WalletPlanMapperInterface
{

    /**
     * @inheritDoc
     */
    public static function createWalletPlanFromHttpRequest(Request $request): WalletPlanEntityInterface
    {
        $payload = $request->json()->all();
        return WalletPlanEntity::fromArray([
                'name'=>$payload['name'],
                'currency'=>$payload['currency'],
                'organizations'=>  $request->get('ApiConsumer')->getOrganizations(),
                'status'=>$payload['status'],
                'compliance'=>$payload['compliance']
            ]
        );
    }
}
