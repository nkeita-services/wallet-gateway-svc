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
    private $accountId;

    /**
     * AccountEntity constructor.
     * @param string $accountType
     * @param float|null $balance
     * @param string|null $userId
     * @param string $accountId
     */
    public function __construct(string $accountType, ?float $balance, ?string $userId, ?string $accountId)
    {
        $this->accountType = $accountType;
        $this->balance = $balance;
        $this->userId = $userId;
        $this->accountId = $accountId;
    }


    public static function fromArray(array $data): AccountEntityInterface
    {
        return new static(
            $data['accountType'] ?? 'regular',
            $data['balance'] ?? 0,
            $data['userId'] ?? null,
            $data['accountId'] ?? null
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
            'accountId' => $this->accountId
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
}
