<?php


namespace Infrastructure\Api\Rest\Client\User\Document;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Infrastructure\Api\Rest\Client\User\Beneficiary\Exception\BeneficiaryNotFoundException;
use Infrastructure\Api\Rest\Client\User\Beneficiary\Mapper\UserBeneficiaryMapper;

class ComplianceApiGuzzleHttpClient implements ComplianceApiClientInterface
{
    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * BeneficiaryApiClient constructor.
     * @param Client $guzzleClient
     */
    public function __construct(Client $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    /**
     * @param string $userId
     * @return array
     */
    public function getUserKyc(string $userId): array
    {
        try {
            $response = $this->guzzleClient->get(
                sprintf('/v1/compliance/documents/users/%s/kyc-status', $userId)
            );

            $data = json_decode(
                $response->getBody()->getContents(),
                true
            );
            return $data['data']['UserKycDetails'];
        } catch (ClientException $e) {
            throw $e;
        }
    }
}
