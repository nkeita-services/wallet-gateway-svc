<?php


namespace Infrastructure\Api\Rest\Client\User\Beneficiary\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\User\Beneficiary\Collection\BeneficiaryCollectionInterface;
use Wallet\Wallet\User\Beneficiary\Entity\BeneficiaryEntityInterface;

interface UserBeneficiaryMapperInterface
{
    /**
     * @param ResponseInterface $response
     * @return BeneficiaryEntityInterface
     */
    public function createUserBeneficiaryFromApiResponse(ResponseInterface $response):BeneficiaryEntityInterface;

    /**
     * @param ResponseInterface $response
     * @return BeneficiaryCollectionInterface
     */
    public function createUserBeneficiaryCollectionFromApiResponse(
        ResponseInterface $response
    ):BeneficiaryCollectionInterface;
}
