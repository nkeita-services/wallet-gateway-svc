<?php


namespace Wallet\Wallet\User\Repository;


use Infrastructure\Api\Rest\Client\User\UserApiClientInterface;
use Wallet\User\Entity\UserEntityInterface;
use Infrastructure\Api\Rest\Client\User\Exception\UserNotFoundException as ApiClientUserNotFoundException;
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
        return $this->userApiClient->create([
            'lastName' => $userEntity->getLastName(),
            'firstName' => $userEntity->getFirstName(),
            'address' => $userEntity->getAddress(),
            'email' => $userEntity->getEmail(),
            'phoneNumber' => $userEntity->getPhoneNumber(),
            'mobileNumber' => $userEntity->getMobileNumber(),
            'language' => $userEntity->getMobileNumber(),
            'walletOrganizations' => $organizations
        ]);
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


}
