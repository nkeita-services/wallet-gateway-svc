<?php


namespace Infrastructure\Api\Rest\Client\User;


use Infrastructure\Api\Rest\Client\User\Exception\UserNotFoundException;
use Wallet\Wallet\User\Entity\UserEntityInterface;
use Wallet\Wallet\User\Collection\UserCollectionInterface;

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

    /**
     * @param string $email
     * @return UserEntityInterface
     * @throws UserNotFoundException
     */
    public function fetchByEmail(
        string $email
    ): UserEntityInterface;

    /**
     * @param string $mobileNumber
     * @return UserEntityInterface
     * @throws UserNotFoundException
     */
    public function fetchByMobileNumber(
        string $mobileNumber
    ): UserEntityInterface;

    /**
     * @param $filter
     * @return UserCollectionInterface
     */
    public function fetchAll(
        $filter
    ): UserCollectionInterface;

    /**
     * @param array $mobileNumbers
     * @return array
     */
    public function fetchAllAppUser(
        array $mobileNumbers
    ): array;
}
