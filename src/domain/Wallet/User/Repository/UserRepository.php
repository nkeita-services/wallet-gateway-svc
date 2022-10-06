<?php


namespace Wallet\Wallet\User\Repository;


use Infrastructure\Api\Rest\Client\User\UserApiClientInterface;
use Wallet\Wallet\User\Entity\UserEntityInterface;
use Infrastructure\Api\Rest\Client\User\Exception\UserNotFoundException as ApiClientUserNotFoundException;
use Wallet\Wallet\User\Collection\UserCollectionInterface;
use Wallet\Wallet\User\Repository\Exception\UserNotFoundException;

class UserRepository implements UserRepositoryInterface
{

    /**
     * @var UserApiClientInterface
     */
    private $userApiClient;

    /**
     * UserRepository constructor.
     * @param UserApiClientInterface $userApiClient
     */
    public function __construct(UserApiClientInterface $userApiClient)
    {
        $this->userApiClient = $userApiClient;
    }


    /**
     * @param UserEntityInterface $userEntity
     * @param array $organizations
     * @return UserEntityInterface
     */
    public function create(UserEntityInterface $userEntity, array $organizations): UserEntityInterface
    {
        return $this->userApiClient->create(
            $userEntity
                ->setWalletOrganizations(
                    $organizations
                )
                ->toArray()
        );
    }

    /**
     * @inheritDoc
     */
    public function fetch(string $userId): UserEntityInterface
    {
        try {
            return $this->userApiClient->get(
                $userId
            );
        } catch (ApiClientUserNotFoundException $e) {
            throw new UserNotFoundException(
                $e->getMessage()
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function fetchByEmail(
        string $email
    ): UserEntityInterface
    {
        try {
            return $this->userApiClient->fetchByEmail(
                $email
            );
        } catch (ApiClientUserNotFoundException $e) {
            throw new UserNotFoundException(
                $e->getMessage()
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function fetchByMobileNumber(
        string $mobileNumber
    ): UserEntityInterface
    {
        try {
            return $this->userApiClient->fetchByMobileNumber(
                $mobileNumber
            );
        } catch (ApiClientUserNotFoundException $e) {
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
       return $this->userApiClient->fetchAll(
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
        return $this->userApiClient
            ->fetchAllAppUser(
                $mobileNumbers
        );
    }


}
