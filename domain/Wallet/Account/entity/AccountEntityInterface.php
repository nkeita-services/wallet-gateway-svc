<?php


namespace Wallet\Account\Entity;


interface AccountEntityInterface
{

    /**
     * @return string
     */
    public function getAccountType(): string;

    /**
     * @return float|null
     */
    public function getBalance(): ?float;
    /**
     * @return string|null
     */
    public function getUserId(): ?string;
}
