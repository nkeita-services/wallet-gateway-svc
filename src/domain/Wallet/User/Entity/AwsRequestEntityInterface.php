<?php


namespace Wallet\Wallet\User\Entity;


interface AwsRequestEntityInterface
{

    /**
     * @param array $data
     * @return AwsRequestEntityInterface
     */
    public static function fromArray(array $data): AwsRequestEntityInterface;

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return string
     */
    public function getUsername(): string;

    /**
     * @return string
     */
    public function getUserId(): string;

    /**
     * @return string
     */
    public function getPassword(): string;

    /**
     * @return string
     */
    public function getPhoneNumber(): string;

    /**
     * @return string
     */
    public function getUserCode(): string;


    /**
     * @return string
     */
    public function getAccessToken(): string;

    /**
     * @return string
     */
    public function getChallengeName(): string;

    /**
     * @return string
     */
    public function getSession(): string;

    /**
     * @return string
     */
    public function getConfirmationCode(): string;

    /**
     * @return string
     */
    public function getPreviousPassword(): string;

    /**
     * @return string
     */
    public function getProposedPassword(): string;

}
