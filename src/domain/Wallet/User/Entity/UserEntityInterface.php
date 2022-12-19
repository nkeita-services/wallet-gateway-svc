<?php


namespace Wallet\Wallet\User\Entity;



interface UserEntityInterface
{

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @param array $data
     * @return UserEntityInterface
     */
    public static function fromArray(
        array $data
    ):UserEntityInterface;

    /**
     * @return array
     */
    public function toArrayAppUser():array;

    /**
     * @return string
     */
    public function getUserId(): string;

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
    public function getBirthDay(): string;

    /**
     * @return string
     */
    public function getNationality(): string;

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
     * @return string
     */
    public function getDateSigned(): string;

    /**
     * @return array
     */
    public function getDevice(): array;

    /**
     * @return array
     */
    public function getWalletOrganizations(): array;

    /**
     * @param array $organizations
     * @return UserEntityInterface
     */
    public function setWalletOrganizations(
        array $organizations
    ): UserEntityInterface;
}
