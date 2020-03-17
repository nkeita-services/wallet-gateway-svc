<?php


namespace Infrastructure\Api\Rest\Client\User;


use Wallet\User\Entity\UserEntityInterface;

interface UserApiClientInterface
{
    public function create(array $userPayload);

    /**
     * @param string $userId
     * @return UserEntityInterface
     */
    public function get(string $userId): UserEntityInterface;
}
