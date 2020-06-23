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
    ){
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
}
