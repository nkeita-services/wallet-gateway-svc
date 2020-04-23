<?php


namespace Wallet\Account\Entity;


class AccountEntity implements AccountEntityInterface
{
    /**
     * @var string
     */
    private $accountType;

    /**
     * @var float|null
     */
    private $balance;

    /**
     * @var string|null
     */
    private $userId;

    /**
     * @var string
     */
    private $walletPlanId;

    /**
     * @var array
     */
    private $organizations;

    /**
     * @var string
     */
    private $accountId;

    /**
     * @var int
     */
    private $createdAt;

    /**
     * @var int
     */
    private $modifiedAt;

    /**
     * @var string
     */
    private $status;

    /**
     * AccountEntity constructor.
     * @param string $accountType
     * @param float|null $balance
     * @param string|null $userId
     * @param string $walletPlanId
     * @param string $accountId
     * @param array $organizations
     * @param int $createdAt
     * @param int $modifiedAt
     * @param string $status
     */
    public function __construct(
        string $accountType = null,
        float $balance = 0,
        string $userId = null,
        string $walletPlanId = null,
        string $accountId = null,
        array $organizations = null,
        int $createdAt = null,
        int $modifiedAt = null,
        string $status = null
    ){
        $this->accountType = $accountType;
        $this->balance = $balance;
        $this->userId = $userId;
        $this->walletPlanId = $walletPlanId;
        $this->organizations = $organizations;
        $this->accountId = $accountId;
        $this->createdAt = $createdAt;
        $this->modifiedAt = $modifiedAt;
        $this->status;
    }


    public static function fromArray(array $data): AccountEntityInterface
    {
        return new static(
            $data['accountType'] ?? 'regular',
            $data['balance'] ?? 0,
            $data['userId'] ?? null,
            $data['walletPlanId'] ?? null,
            $data['accountId'] ?? null,
            $data['organizations'] ?? null,
            $data['createdAt'] ?? null,
            $data['modifiedAt'] ?? null,
            $data['status'] ?? null
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'accountType' => $this->accountType,
            'userId' => $this->userId,
            'balance' => $this->balance,
            'accountId' => $this->accountId,
            'walletPlanId'=>$this->walletPlanId,
            'organizations'=>$this->organizations,
            'createdAt'=>$this->createdAt,
            'modifiedAt'=>$this->modifiedAt,
            'status'=>$this->status
        ];
    }

    /**
     * @return string
     */
    public function getAccountType(): string
    {
        return $this->accountType;
    }

    /**
     * @return float|null
     */
    public function getBalance(): ?float
    {
        return $this->balance;
    }

    /**
     * @return string|null
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getWalletPlanId(): string
    {
        return $this->walletPlanId;
    }

    /**
     * @return array
     */
    public function getOrganizations(): array
    {
        return $this->organizations;
    }

    /**
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }
}
