<?php


namespace Wallet\User\Entity;


class UserEntity implements UserEntityInterface
{

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var array
     */
    private $address;


    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var string
     */
    private $mobileNumber;

    /**
     * @var string
     */
    private $language;

    /**
     * @var array
     */
    private $walletOrganizations;

    /**
     * @var string
     */
    private $userId;

    /**
     * UserEntity constructor.
     * @param string $lastName
     * @param string $firstName
     * @param array $address
     * @param string $email
     * @param string $phoneNumber
     * @param string $mobileNumber
     * @param string $language
     * @param array $walletOrganizations
     * @param string $userId
     */
    public function __construct(string $lastName, string $firstName, array $address, string $email, string $phoneNumber, string $mobileNumber, string $language, array $walletOrganizations, string $userId = null)
    {
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->address = $address;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->mobileNumber = $mobileNumber;
        $this->language = $language;
        $this->walletOrganizations = $walletOrganizations;
        $this->userId = $userId;
    }


    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'lastName' => $this->lastName,
            'firstName' => $this->firstName,
            'address' => $this->address,
            'email' => $this->email,
            'phoneNumber' => $this->phoneNumber,
            'mobileNumber' => $this->mobileNumber,
            'language' => $this->language,
            'walletOrganizations' => $this->walletOrganizations,
            'userId'=>$this->userId
        ];
    }


    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return array
     */
    public function getAddress(): array
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getMobileNumber(): string
    {
        return $this->mobileNumber;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @return array
     */
    public function getWalletOrganizations(): array
    {
        return $this->walletOrganizations;
    }
}
