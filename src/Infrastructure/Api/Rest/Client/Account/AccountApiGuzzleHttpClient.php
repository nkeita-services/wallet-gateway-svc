<?php


namespace Infrastructure\Api\Rest\Client\Account;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Infrastructure\Api\Rest\Client\Account\Mapper\AccountMapperInterface;
use Wallet\Account\Entity\AccountEntityInterface;

class AccountApiGuzzleHttpClient implements AccountApiClientInterface
{
    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * @var AccountMapperInterface
     */
    private $accountMapper;

    /**
     * AccountApiGuzzleHttpClient constructor.
     * @param Client $guzzleClient
     * @param AccountMapperInterface $accountMapper
     */
    public function __construct(Client $guzzleClient, AccountMapperInterface $accountMapper)
    {
        $this->guzzleClient = $guzzleClient;
        $this->accountMapper = $accountMapper;
    }


    public function create(array $accountPayload): AccountEntityInterface
    {
        var_dump($accountPayload);exit;
        $response = $this->guzzleClient->post('/v1/accounts', [
            RequestOptions::JSON => $accountPayload
        ]);

        return $this->accountMapper->createAccountFromApiResponse(
            $response
        );
    }
}
