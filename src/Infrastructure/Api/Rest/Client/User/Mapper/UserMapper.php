<?php


namespace Infrastructure\Api\Rest\Client\User\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\User\Entity\UserEntity;
use Wallet\User\Entity\UserEntityInterface;

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
            $userData['data']['walletAccountUser']['userId']
        );
    }
}
