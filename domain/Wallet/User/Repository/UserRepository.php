<?php


namespace Wallet\Wallet\User\Repository;


use Infrastructure\Api\Rest\Client\Account\AccountApiClientInterface;
use Infrastructure\Api\Rest\Client\User\UserApiClientInterface;
use Wallet\User\Entity\UserEntityInterface;

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


    public function create(UserEntityInterface $userEntity): UserEntityInterface
    {
        return $this->userApiClient->create([
            'lastName' => $userEntity->getLastName(),
            'firstName' => $userEntity->getFirstName(),
            'address' => $userEntity->getAddress(),
            'email' => $userEntity->getEmail(),
            'phoneNumber' => $userEntity->getPhoneNumber(),
            'mobileNumber' => $userEntity->getMobileNumber(),
            'language' => $userEntity->getMobileNumber(),
            'walletOrganizations' => $userEntity->getWalletOrganizations()
        ]);
    }

    /**
     * @inheritDoc
     */
    public function fetch(string $userId): UserEntityInterface
    {
        return $this->userApiClient->get(
            $userId
        );
    }


}
