<?php


namespace Infrastructure\Api\Rest\Client\User;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Infrastructure\Api\Rest\Client\User\Mapper\UserMapperInterface;
use Wallet\User\Entity\UserEntity;
use Wallet\User\Entity\UserEntityInterface;

class UserApiGuzzleHttpClient implements UserApiClientInterface
{

    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * @var UserMapperInterface
     */
    private $userMapper;

    /**
     * UserApiGuzzleHttpClient constructor.
     * @param Client $guzzleClient
     * @param UserMapperInterface $userMapper
     */
    public function __construct(Client $guzzleClient, UserMapperInterface $userMapper)
    {
        $this->guzzleClient = $guzzleClient;
        $this->userMapper = $userMapper;
    }


    public function create(array $userPayload)
    {

        $response = $this->guzzleClient->post('/v1/users', [
            RequestOptions::JSON => $userPayload
        ]);

        return $this->userMapper->createUserFromApiResponse(
            $response
        );
    }

    public function get(string $userId): UserEntityInterface
    {

        $response = $this->guzzleClient->get(
            sprintf('/v1/users/%s', $userId)
        );

        return $this->userMapper->createUserFromApiResponse(
            $response
        );
    }
}
