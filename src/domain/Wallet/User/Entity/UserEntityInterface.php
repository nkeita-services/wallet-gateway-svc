<?php


namespace Wallet\User\Entity;


use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;

interface UserEntityInterface
{

    /**
     * @return array
     */
    public function toArray(): array ;

    /**
     * @param array $data
     * @return UserEntityInterface
     */
    public static function fromArray(
        array $data
    ):UserEntityInterface;

    /**
     * @return string
     */
    public function getLastName(): string;

    /**
     * @return string
     */
    public function getFirstName(): string;
    /**
     * @return array
     */
    public function getAddress(): array;
    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return string
     */
    public function getPhoneNumber(): string;

    /**
     * @return string
     */
    public function getMobileNumber(): string;

    /**
     * @return string
     */
    public function getLanguage(): string;

    /**
     * @return array
     */
    public function getWalletOrganizations(): array;
}
