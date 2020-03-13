<?php


namespace Infrastructure\Api\Rest\Client\User\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\User\Entity\UserEntityInterface;

interface UserMapperInterface
{
    /**
     * @param ResponseInterface $response
     * @return UserEntityInterface
     */
    public function createUserFromApiResponse(ResponseInterface $response):UserEntityInterface;
}
