<?php


namespace Infrastructure\Api\Rest\Client\Account\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Account\Entity\AccountEntityInterface;

interface AccountMapperInterface
{

    /**
     * @param ResponseInterface $response
     * @return AccountEntityInterface
     */
    public function createAccountFromApiResponse(ResponseInterface $response):AccountEntityInterface;
}
