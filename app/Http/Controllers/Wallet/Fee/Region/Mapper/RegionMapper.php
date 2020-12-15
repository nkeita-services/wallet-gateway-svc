<?php


namespace App\Http\Controllers\Wallet\Fee\Region\Mapper;


use Illuminate\Http\Request;
use Wallet\Wallet\Fee\Region\Entity\RegionEntity;
use Wallet\Wallet\Fee\Region\Entity\RegionEntityInterface;

class RegionMapper implements RegionMapperInterface
{
    /**
     * @param Request $request
     * @return RegionEntityInterface
     */
    public static function createRegionFromHttpRequest(
        Request $request
    ): RegionEntityInterface
    {
        $payload = $request->json()->all();
        return RegionEntity::fromArray([
                'name'=>$payload['name'],
                'walletOrganizations'=> $request->get('ApiConsumer')->getOrganizations(),
                'countryCodes'=>$payload['countryCodes']
            ]
        );
    }
}
