<?php


namespace Infrastructure\Api\Rest\Client\User;


use Infrastructure\Api\Rest\Client\User\Exception\UserNotFoundException;
use Wallet\User\Entity\UserEntityInterface;

interface UserApiClientInterface
{
    /**
     * @param array $userPayload
     * @return mixed
     */
    public function create(array $userPayload);

    /**
     * @param string $userId
     * @return UserEntityInterface
     * @throws UserNotFoundException
     */
    public function get(string $userId): UserEntityInterface;
}
