<?php


namespace Wallet\Wallet\User\Beneficiary\Entity;


interface BeneficiaryEntityInterface
{
    /**
     * @return array
     */
    public function toArray(): array ;

    /**
     * @param array $data
     * @return BeneficiaryEntityInterface
     */
    public static function fromArray(
        array $data
    ):BeneficiaryEntityInterface;


    /**
     * @return string
     */
    public function getBeneficiaryId(): string;

    /**
     * @return string
     */
    public function getUserId(): string;

    /**
     * @return string
     */
    public function getBeneficiaryType(): string;

    /**
     * @return array
     */
    public function getBeneficiaryDetails(): array;

    /**
     * @return array
     */
    public function getTransferNotification(): array;

    /**
     * @return array
     */
    public function getBeneficiaryAccountDetails(): array;

    /**
     * @return string
     */
    public function getCreatedAt(): string;
    /**
     * @return string
     */
    public function getModifiedAt(): string;

    /**
     * @return string
     */
    public function getStatus(): string;
    /**
     * @return array
     */
    public function getOrganizations(): array;

    /**
     * @return array
     */
    public function getBeneficiaryAccountIdentifiers(): array ;

    /**
     * @param string $accountType
     * @param string $accountIdentifierName
     * @return string
     */
    public function getBeneficiaryAccountIdentifierValueFor(
        string $accountType,
        string $accountIdentifierName
    ): string;

    /**
     * @return string
     */
    public function getBeneficiaryName(): string;
}
