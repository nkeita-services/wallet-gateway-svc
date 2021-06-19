<?php

namespace Wallet\Wallet\User\Service;


use Wallet\Wallet\User\Entity\UserEntityInterface;
use Wallet\Wallet\User\Collection\UserCollectionInterface;
use Wallet\Wallet\User\Service\Exception\UserNotFoundException;

interface UserServiceInterface
{

    /**
     * @param UserEntityInterface $userEntity
     * @param array $organizations
     * @return UserEntityInterface
     */
    public function create(
        UserEntityInterface $userEntity,
        array $organizations
    ):UserEntityInterface;

    /**
     * @param string $userId
     * @return UserEntityInterface
     * @throws UserNotFoundException
     */
    public function fetch(
        string $userId
    ): UserEntityInterface;

    /**
     * @param array $filter
     * @return UserCollectionInterface
     */
    public function fetchAll(
        array $filter
    ): UserCollectionInterface;

    /**
     * @param array $mobileNumbers
     * @return array
     */
    public function fetchAllAppUser(
        array $mobileNumbers
    ): array;

}
