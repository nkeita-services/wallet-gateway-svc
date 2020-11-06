<?php


namespace Infrastructure\Api\Rest\Client\User\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\User\Entity\UserEntityInterface;
use Wallet\Wallet\User\Collection\UserCollectionInterface;

interface UserMapperInterface
{
    /**
     * @param ResponseInterface $response
     * @return UserEntityInterface
     */
    public function createUserFromApiResponse(ResponseInterface $response):UserEntityInterface;

    /**
     * @param ResponseInterface $response
     * @return UserCollectionInterface
     */
    public function createUserCollectionFromApiResponse(
        ResponseInterface $response
    ):UserCollectionInterface;
}
