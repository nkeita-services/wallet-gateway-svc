<?php


namespace Wallet\Wallet\User\Beneficiary\Entity;


class BeneficiaryEntity implements BeneficiaryEntityInterface
{
    /**
     * @var string
     */
    private $beneficiaryId;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $beneficiaryType;

    /**
     * @var array
     */
    private $beneficiaryDetails;

    /**
     * @var array
     */
    private $transferNotification;

    /**
     * @var array
     */
    private $beneficiaryAccountDetails;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * @var string
     */
    private $modifiedAt;

    /**
     * @var string
     */
    private $status;

    /**
     * @var array
     */
    private $organizations;

    /**
     * BeneficiaryEntity constructor.
     * @param string $beneficiaryId
     * @param string $userId
     * @param string $beneficiaryType
     * @param array $beneficiaryDetails
     * @param array $transferNotification
     * @param array $beneficiaryAccountDetails
     * @param string $createdAt
     * @param string $modifiedAt
     * @param string $status
     * @param array $organizations
     */
    public function __construct(
        ?string $beneficiaryId,
        ?string $userId,
        ?string $beneficiaryType,
        ?array $beneficiaryDetails,
        ?array $transferNotification,
        ?array $beneficiaryAccountDetails,
        ?string $createdAt,
        ?string $modifiedAt,
        ?string $status,
        ?array $organizations
    )
    {
        $this->beneficiaryId = $beneficiaryId;
        $this->userId = $userId;
        $this->beneficiaryType = $beneficiaryType;
        $this->beneficiaryDetails = $beneficiaryDetails;
        $this->transferNotification = $transferNotification;
        $this->beneficiaryAccountDetails = $beneficiaryAccountDetails;
        $this->createdAt = $createdAt;
        $this->modifiedAt = $modifiedAt;
        $this->status = $status;
        $this->organizations = $organizations;
    }


    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'beneficiaryId' => $this->beneficiaryId,
            'userId' => $this->userId,
            'beneficiaryType' => $this->beneficiaryType,
            'beneficiaryDetails' => $this->beneficiaryDetails,
            'transferNotification' => $this->transferNotification,
            'beneficiaryAccountDetails' => $this->beneficiaryAccountDetails,
            'createdAt' => $this->createdAt,
            'modifiedAt' => $this->modifiedAt,
            'status' => $this->status,
            'organizations' => $this->organizations,
        ];
    }

    /**
     * @inheritDoc
     */
    public static function fromArray(array $data): BeneficiaryEntityInterface
    {
        return new static(
            $data['beneficiaryId'] ?? null,
            $data['userId'] ?? null,
            $data['beneficiaryType'] ?? null,
            $data['beneficiaryDetails'] ?? null,
            $data['transferNotification'] ?? null,
            $data['beneficiaryAccountDetails'] ?? null,
            $data['createdAt'] ?? null,
            $data['modifiedAt'] ?? null,
            $data['status'] ?? null,
            $data['organizations'] ?? null
        );
    }

    /**
     * @return string
     */
    public function getBeneficiaryId(): string
    {
        return $this->beneficiaryId;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getBeneficiaryType(): string
    {
        return $this->beneficiaryType;
    }

    /**
     * @return array
     */
    public function getBeneficiaryDetails(): array
    {
        return $this->beneficiaryDetails;
    }

    /**
     * @return array
     */
    public function getTransferNotification(): array
    {
        return $this->transferNotification;
    }

    /**
     * @return array
     */
    public function getBeneficiaryAccountDetails(): array
    {
        return $this->beneficiaryAccountDetails;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getModifiedAt(): string
    {
        return $this->modifiedAt;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function getOrganizations(): array
    {
        return $this->organizations;
    }

    /**
     * @inheritDoc
     */
    public function getBeneficiaryAccountIdentifiers(): array
    {
        return $this->beneficiaryAccountDetails['accountIdentifiers'];
    }

    /**
     * @inheritDoc
     */
    public function getBeneficiaryAccountIdentifierValueFor(
        string $accountType,
        string $accountIdentifierName): string
    {
        if ($this->beneficiaryAccountDetails['accountType'] == $accountType) {
            foreach ($this->beneficiaryAccountDetails['accountIdentifiers'] as $accountIdentifier){
                if($accountIdentifier['AccountIdentifierName'] == $accountIdentifierName){
                    return  $accountIdentifier['AccountIdentifierValue'];
                }
            }
        } else {
            throw new \DomainException(
                sprintf('Account type is not %s' . $accountType)
            );
        }
        throw new \DomainException(
            sprintf('No value found for account type %s' . $accountType)
        );


    }


}
