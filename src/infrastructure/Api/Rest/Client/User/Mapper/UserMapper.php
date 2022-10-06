<?php


namespace Infrastructure\Api\Rest\Client\User\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\User\Entity\UserEntity;
use Wallet\Wallet\User\Entity\UserEntityInterface;
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

        return  UserEntity::fromArray(
            $userData['data']['walletAccountUser']
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

    /**
     * @param ResponseInterface $response
     * @return array
     */
    public function mobileNumber(ResponseInterface $response):array
    {
        $data = json_decode(
            $response->getBody()->getContents(),
            true
        );

        $appUserCollection = UserCollection::fromArray(
            $data['data']['walletAccounts']
        );

        return $appUserCollection->toArrayAppUser();
    }


}
