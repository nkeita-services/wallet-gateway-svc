<?php


namespace Infrastructure\Api\Rest\Client\User\Beneficiary;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\RequestOptions;
use Infrastructure\Api\Rest\Client\User\Beneficiary\Exception\BeneficiaryNotFoundException;
use Infrastructure\Api\Rest\Client\User\Beneficiary\Mapper\UserBeneficiaryMapper;
use Wallet\Wallet\User\Beneficiary\Collection\BeneficiaryCollectionInterface;
use Wallet\Wallet\User\Beneficiary\Entity\BeneficiaryEntityInterface;
use DomainException;

class BeneficiaryApiClient implements BeneficiaryApiClientInterface
{

    /**
     * @var UserBeneficiaryMapper
     */
    private $beneficiaryMapper;


    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * BeneficiaryApiClient constructor.
     * @param UserBeneficiaryMapper $beneficiaryMapper
     * @param Client $guzzleClient
     */
    public function __construct(UserBeneficiaryMapper $beneficiaryMapper, Client $guzzleClient)
    {
        $this->beneficiaryMapper = $beneficiaryMapper;
        $this->guzzleClient = $guzzleClient;
    }


    /**
     * @inheritDoc
     */
    public function create(
        array $beneficiaryPayload,
        string $userId): BeneficiaryEntityInterface
    {

        $response = $this->guzzleClient->post(sprintf('/v1/users/%s/beneficiaries',$userId), [
            RequestOptions::JSON => $beneficiaryPayload
        ]);

        return $this->beneficiaryMapper->createUserBeneficiaryFromApiResponse(
            $response
        );
    }

    /**
     * @inheritDoc
     */
    public function get(
        string $beneficiaryId,
        string $userId
    ): BeneficiaryEntityInterface
    {
        try {
            $response = $this->guzzleClient->get(
                sprintf('/v1/users/%s/beneficiaries/%s', $userId,$beneficiaryId)
            );
        } catch (ClientException $e) {
            if($e->getResponse()->getStatusCode() == 404){
                throw new BeneficiaryNotFoundException(
                    sprintf('Beneficiary %s not found', $beneficiaryId)
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

        return $this->beneficiaryMapper->createUserBeneficiaryFromApiResponse(
            $response
        );
    }

    /**
     * @inheritDoc
     */
    public function fetchAll(
        $filter,
        string $userId
    ): BeneficiaryCollectionInterface{
        try {
            $response = $this->guzzleClient->get(
                sprintf('/v1/users/%s/beneficiaries',$userId)
            );

            return $this->beneficiaryMapper->createUserBeneficiaryCollectionFromApiResponse(
                $response
            );
        } catch (ClientException $e) {
            throw $e;
        }
    }
}
