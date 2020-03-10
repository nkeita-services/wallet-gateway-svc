<?php


namespace Wallet\Account\Entity;


class AccountEntity implements AccountEntityInterface
{
    private $accountType;

    private $balance;

    private $userId;

    private function __construct(
        string $accountType,
        ?string $userId = null,
        ?float $balance = 0){

        $this->accountType = $accountType;
        $this->userId = $userId;
        $this->balance = $balance;
    }

    public static function fromArray(array $data): AccountEntityInterface
    {
        return new static(
            $data['accountType'] ?? 'regular',
            $data['userId'] ?? null,
            $data['balance'] ?? 0
        );
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
