<?php


namespace Infrastructure\Api\Rest\Client\User;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\RequestOptions;
use Infrastructure\Api\Rest\Client\User\Exception\UserNotFoundException;
use Infrastructure\Api\Rest\Client\User\Mapper\UserMapperInterface;
use Wallet\Wallet\User\Entity\UserEntityInterface;
use DomainException;
use Wallet\Wallet\User\Collection\UserCollectionInterface;

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

    /**
     * @inheritDoc
     */
    public function fetchByEmail(
        string $email
    ): UserEntityInterface
    {
        try {
            $response = $this->guzzleClient->post('/v1/users/email', [
                RequestOptions::JSON => ["email" => $email]
            ]);
        } catch (ClientException $e) {
            if($e->getResponse()->getStatusCode() == 404){
                throw new UserNotFoundException(
                    sprintf('User %s not found', $email)
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

    /**
     * @inheritDoc
     */
    public function fetchByMobileNumber(
        string $mobileNumber
    ): UserEntityInterface
    {
        try {
            $response = $this->guzzleClient->post('/v1/users/phone', [
                RequestOptions::JSON => ["mobileNumber" => $mobileNumber]
            ]);

        } catch (ClientException $e) {
            if($e->getResponse()->getStatusCode() == 404){
                throw new UserNotFoundException(
                    sprintf('User %s not found', $mobileNumber)
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

    /**
     * @inheritDoc
     */
    public function fetchAll($filter): UserCollectionInterface
    {
        try {
            $response = $this->guzzleClient->get(
                sprintf('/v1/users')
            );

            return $this->userMapper->createUserCollectionFromApiResponse(
                $response
            );
        } catch (ClientException $e) {
            throw $e;
        }
    }

    /**
     * @param array $mobileNumbers
     * @return array
     */
    public function fetchAllAppUser(
        array $mobileNumbers
    ): array
    {
        try {

            $response = $this->guzzleClient->post('/v1/users/app/users', [
                RequestOptions::JSON => $mobileNumbers
            ]);

            return $this->userMapper->mobileNumber(
                $response
            );
        } catch (ClientException $e) {
            throw $e;
        }
    }


}
