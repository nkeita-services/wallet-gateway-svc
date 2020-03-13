<?php


namespace Wallet\Wallet\User\Repository;


use Wallet\User\Entity\UserEntityInterface;

interface UserRepositoryInterface
{

    /**
     * @param UserEntityInterface $userEntity
     * @return UserEntityInterface
     */
    public function create(UserEntityInterface $userEntity):UserEntityInterface;

    /**
     * @param string $userId
     * @return UserEntityInterface
     */
    public function fetch(string $userId):UserEntityInterface;
}
