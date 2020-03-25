<?php


namespace Wallet\Wallet\User\Service;


use Wallet\User\Entity\UserEntityInterface;
use Wallet\Wallet\User\Repository\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function create(
        UserEntityInterface $userEntity,
        array $organizations
    ): UserEntityInterface
    {
        return $this->userRepository->create(
            $userEntity,
            $organizations
        );
    }

    /**
     * @inheritDoc
     */
    public function fetch(string $userId): UserEntityInterface
    {
        return $this->userRepository->fetch(
            $userId
        );
    }


}
