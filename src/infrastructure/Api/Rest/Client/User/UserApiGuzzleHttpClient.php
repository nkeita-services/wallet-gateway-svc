<?php


namespace Infrastructure\Api\Rest\Client\User;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\RequestOptions;
use Infrastructure\Api\Rest\Client\User\Exception\UserNotFoundException;
use Infrastructure\Api\Rest\Client\User\Mapper\UserMapperInterface;
use Wallet\User\Entity\UserEntityInterface;
use DomainException;

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

        try {
            $response = $this->guzzleClient->get(
                sprintf('/v1/users/%s', $userId)
            );
        } catch (ClientException $e) {
            if($e->getResponse()->getStatusCode() == 404){
                throw new UserNotFoundException(
                    sprintf('User %s not found', $userId)
                );
            }

            throw $e;
        }catch (ServerException $e){
            $decodedPayload = json_decode(
                $e->getResponse()->getBody()->getContents(), true
            );

            throw new DomainException(
                $decodedPayload['StatusDescription']
            );
        }

        return $this->userMapper->createUserFromApiResponse(
            $response
        );
    }
}
