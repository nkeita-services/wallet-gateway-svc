<?php


namespace Wallet\Wallet\User\PaymentMean\Entity;


class PaymentMeanEntity implements PaymentMeanEntityInterface
{

    /**
     * @var string
     */
    private $paymentMeanId;

    /**
     * @var
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string;
     */
    private $status;

    /**
     * @var array
     */
    private $debitCardDetails;

    /**
     * @var array
     */
    private $bankAccountDetails;

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
    private $userId;

    /**
     * @var array
     */
    private $organizations;

    /**
     * PaymentMeanEntity constructor.
     * @param string $paymentMeanId
     * @param string $name
     * @param string $type
     * @param string $status
     * @param array $debitCardDetails
     * @param array $bankAccountDetails
     * @param string $createdAt
     * @param string $modifiedAt
     * @param string $userId
     * @param array $organizations
     */
    public function __construct(
        ?string $paymentMeanId,
        ?string $name,
        ?string $type,
        ?string $status,
        ?array $debitCardDetails,
        ?array $bankAccountDetails,
        ?string $createdAt,
        ?string $modifiedAt,
        ?string $userId,
        ?array $organizations
    ){
        $this->paymentMeanId = $paymentMeanId;
        $this->name = $name;
        $this->type = $type;
        $this->status = $status;
        $this->debitCardDetails = $debitCardDetails;
        $this->bankAccountDetails = $bankAccountDetails;
        $this->createdAt = $createdAt;
        $this->modifiedAt = $modifiedAt;
        $this->userId = $userId;
        $this->organizations = $organizations;
    }


    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'paymentMeanId' => $this->paymentMeanId,
            'name' => $this->name,
            'userId' => $this->userId,
            'type' => $this->type,
            'debitCardDetails' => $this->debitCardDetails,
            'bankAccountDetails' => $this->bankAccountDetails,
            'createdAt' => $this->createdAt,
            'modifiedAt' => $this->modifiedAt,
            'status' => $this->status,
            'organizations' => $this->organizations,
        ];
    }

    /**
     * @inheritDoc
     */
    public static function fromArray(array $data): PaymentMeanEntityInterface
    {
        return new static(
            $data['paymentMeanId'] ?? null,
            $data['name'] ?? null,
            $data['type'] ?? null,
            $data['status'] ?? null,
            $data['debitCardDetails'] ?? null,
            $data['bankAccountDetails'] ?? null,
            $data['createdAt'] ?? null,
            $data['modifiedAt'] ?? null,
            $data['userId'] ?? null,
            $data['organizations'] ?? null
        );
    }
}
