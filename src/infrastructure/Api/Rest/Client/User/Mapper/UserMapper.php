<?php


namespace Infrastructure\Api\Rest\Client\User\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\User\Entity\UserEntity;
use Wallet\User\Entity\UserEntityInterface;
use Wallet\Wallet\Plan\Collection\PlanCollection;
use Wallet\Wallet\User\Collection\UserCollection;
use Wallet\Wallet\User\Collection\UserCollectionInterface;

class UserMapper implements UserMapperInterface
{

    /**
     * @inheritDoc
     */
    public function createUserFromApiResponse(ResponseInterface $response): UserEntityInterface
    {
        $userData = json_decode(
            $response->getBody()->getContents(),
            true
        );

        return new UserEntity(
            $userData['data']['walletAccountUser']['lastName'],
            $userData['data']['walletAccountUser']['firstName'],
            $userData['data']['walletAccountUser']['address'],
            $userData['data']['walletAccountUser']['email'],
            $userData['data']['walletAccountUser']['phoneNumber'],
            $userData['data']['walletAccountUser']['mobileNumber'],
            $userData['data']['walletAccountUser']['language'],
            $userData['data']['walletAccountUser']['walletOrganizations'],
            $userData['data']['walletAccountUser']['userId'],
            $userData['data']['walletAccountUser']['createdAt'],
            $userData['data']['walletAccountUser']['status']
        );
    }

    /**
     * @inheritDoc
     */
    public function createUserCollectionFromApiResponse(ResponseInterface $response): UserCollectionInterface
    {
        $data = json_decode(
            $response->getBody()->getContents(),
            true
        );

        return UserCollection::fromArray(
            $data['data']['walletAccounts']
        );
    }


}
