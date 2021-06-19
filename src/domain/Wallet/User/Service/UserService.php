<?php


namespace Wallet\Wallet\User\Service;


use Wallet\Wallet\User\Entity\UserEntityInterface;
use Wallet\Wallet\User\Collection\UserCollectionInterface;
use Wallet\Wallet\User\Repository\UserRepositoryInterface;
use Wallet\Wallet\User\Repository\Exception\UserNotFoundException as RepositoryUserNotFoundException;
use Wallet\Wallet\User\Service\Exception\UserNotFoundException;

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
        try {
            return $this->userRepository->fetch(
                $userId
            );
        } catch (RepositoryUserNotFoundException $e) {
            throw new UserNotFoundException(
                $e->getMessage()
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function fetchAll(array $filter): UserCollectionInterface
    {
        return $this->userRepository->fetchAll(
            $filter
        );
    }

    /**
     * @param array $mobileNumbers
     * @return array
     */
    public function fetchAllAppUser(
        array $mobileNumbers
    ): array
    {
        return $this->userRepository
            ->fetchAllAppUser(
                $mobileNumbers
            );
    }


}
