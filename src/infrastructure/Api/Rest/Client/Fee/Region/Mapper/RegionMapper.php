<?php


namespace Infrastructure\Api\Rest\Client\Fee\Region\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\Fee\Region\Collection\RegionCollection;
use Wallet\Wallet\Fee\Region\Collection\RegionCollectionInterface;
use Wallet\Wallet\Fee\Region\Entity\RegionEntity;
use Wallet\Wallet\Fee\Region\Entity\RegionEntityInterface;

class RegionMapper implements RegionMapperInterface
{
    /**
     * @param ResponseInterface $response
     * @return RegionEntityInterface
     */
    public function createRegionFromApiResponse(
        ResponseInterface $response
    ):RegionEntityInterface
    {
        $walletPlanData = json_decode(
            $response->getBody()->getContents(),
            true
        );

        return RegionEntity::fromArray(
            $walletPlanData['data']['walletRegion']
        );
    }

    /**
     * @param ResponseInterface $response
     * @return RegionCollectionInterface
     */
    public function createRegionCollectionFromApiResponse(
        ResponseInterface $response
    ): RegionCollectionInterface
    {
        $data = json_decode(
            $response->getBody()->getContents(),
            true
        );

        return RegionCollection::fromArray(
            $data['data']['walletRegions']
        );
    }
}
