<?php


namespace Infrastructure\Api\Rest\Client\User\Beneficiary\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\User\Beneficiary\Collection\BeneficiaryCollection;
use Wallet\Wallet\User\Beneficiary\Collection\BeneficiaryCollectionInterface;
use Wallet\Wallet\User\Beneficiary\Entity\BeneficiaryEntity;
use Wallet\Wallet\User\Beneficiary\Entity\BeneficiaryEntityInterface;

class UserBeneficiaryMapper implements UserBeneficiaryMapperInterface
{

    /**
     * @inheritDoc
     */
    public function createUserBeneficiaryFromApiResponse(ResponseInterface $response): BeneficiaryEntityInterface
    {
        $data = json_decode(
            $response->getBody()->getContents(),
            true
        );

        return BeneficiaryEntity::fromArray(
            $data['data']['userBeneficiary']
        );
    }

    /**
     * @inheritDoc
     */
    public function createUserBeneficiaryCollectionFromApiResponse(ResponseInterface $response): BeneficiaryCollectionInterface
    {
        $data = json_decode(
            $response->getBody()->getContents(),
            true
        );

        return BeneficiaryCollection::fromArray(
            $data['data']['userBeneficiaries']
        );
    }
}
