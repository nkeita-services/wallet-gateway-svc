<?php


namespace Infrastructure\Api\Rest\Client\Account;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class AccountApiGuzzleHttpClient implements AccountApiClientInterface
{
    /**
     * @var Client
     */
    private $guzzleClient;

    public function __construct(Client $client)
    {
        $this->guzzleClient = $client;
    }

    public function create(array $accountPayload)
    {
       $response = $this->guzzleClient->post('/v1/accounts',[
           RequestOptions::JSON => $accountPayload
       ]);

       var_dump($response);exit;
    }


}
