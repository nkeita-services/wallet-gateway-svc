<?php


namespace Infrastructure\Api\Rest\Client\Fee\Fee\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\Fee\Fee\Collection\FeeCollection;
use Wallet\Wallet\Fee\Fee\Collection\FeeCollectionInterface;
use Wallet\Wallet\Fee\Fee\Entity\FeeEntity;
use Wallet\Wallet\Fee\Fee\Entity\FeeEntityInterface;

class FeeMapper implements FeeMapperInterface
{
    /**
     * @param ResponseInterface $response
     * @return FeeEntityInterface
     */
    public function createFeeFromApiResponse(
        ResponseInterface $response
    ):FeeEntityInterface
    {
        $quoteFeeData = json_decode(
            $response->getBody()->getContents(),
            true
        );


        return FeeEntity::fromArray(
            $quoteFeeData['data']['walletFee']
        );
    }

    /**
     * @param ResponseInterface $response
     * @return FeeCollectionInterface
     */
    public function createFeeCollectionFromApiResponse(
        ResponseInterface $response
    ): FeeCollectionInterface
    {
        $data = json_decode(
            $response->getBody()->getContents(),
            true
        );

        return FeeCollection::fromArray(
            $data['data']['walletFees']
        );
    }
}
