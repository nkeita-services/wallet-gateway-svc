<?php

namespace Wallet\Wallet\User\Entity;

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
    private $nationality;

    /**
     * @var string
     */
    private $birthDay;

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
     * @var string
     */
    private $dateSigned;

    /**
     * @var array
     */
    private $walletOrganizations;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var int
     */
    private $createdAt;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $deviceToken;

    /**
     * UserEntity constructor.
     * @param string $lastName
     * @param string $firstName
     * @param array $address
     * @param string $email
     * @param string|null $birthDay
     * @param string|null $nationality
     * @param string $phoneNumber
     * @param string $mobileNumber
     * @param string $language
     * @param string|null $dateSigned
     * @param string|null $deviceToken
     * @param array $walletOrganizations
     * @param string $userId
     * @param int $createdAt
     * @param string $status
     */
    public function __construct(
        ?string $lastName,
        ?string $firstName,
        ?array $address,
        ?string $email,
        ?string $birthDay,
        ?string $nationality,
        ?string $phoneNumber,
        ?string $mobileNumber,
        ?string $language,
        ?string $dateSigned,
        ?string $deviceToken,
        ?array $walletOrganizations = null,
        ?string $userId = null,
        ?int $createdAt = null,
        ?string $status= null
    ){
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->address = $address;
        $this->email = $email;
        $this->birthDay = $birthDay;
        $this->nationality = $nationality;
        $this->phoneNumber = $phoneNumber;
        $this->mobileNumber = $mobileNumber;
        $this->language = $language;
        $this->dateSigned = $dateSigned;
        $this->deviceToken = $deviceToken;
        $this->walletOrganizations = $walletOrganizations;
        $this->userId = $userId;
        $this->createdAt = $createdAt;
        $this->status = $status;
    }

    /**
     * @inheritDoc
     */
    public static function fromArray(
        array $data
    ): UserEntityInterface{
        return new static(
            $data['lastName'] ?? null,
            $data['firstName'] ?? null,
            $data['address'] ?? null,
            $data['email'] ?? null,
            $data['birthDay'] ?? null,
            $data['nationality'] ?? null,
            $data['phoneNumber'] ?? null,
            $data['mobileNumber'] ?? null,
            $data['language'] ?? null,
            $data['dateSigned'] ?? null,
            $data['deviceToken'] ?? null,
            $data['walletOrganizations'] ?? null,
            $data['userId'] ?? null,
            $data['createdAt'] ?? null,
            $data['status'] ?? null
        );
    }
    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        $userData =  [
            'lastName' => $this->lastName,
            'firstName' => $this->firstName,
            'address' => $this->address,
            'email' => $this->email,
            'birthDay' => $this->birthDay,
            'nationality' => $this->nationality,
            'phoneNumber' => $this->phoneNumber,
            'mobileNumber' => $this->mobileNumber,
            'language' => $this->language,
            'dateSigned' => $this->dateSigned,
            'deviceToken' => $this->deviceToken,
            'walletOrganizations' => $this->walletOrganizations,
            'userId'=> $this->userId,
            'createdAt'=> $this->createdAt,
            'status'=> $this->status
        ];

        return array_filter(
            $userData,
            function ($propertyValue, $propertyName){
                return $propertyValue !== null;
            },
            ARRAY_FILTER_USE_BOTH
        );
    }

    /**
     * @inheritDoc
     */
    public function toArrayAppUser():array
    {
        $userData =  [
            'lastName' => $this->lastName,
            'firstName' => $this->firstName,
            'mobileNumber' => $this->mobileNumber,
            'userId'=> $this->userId,
            'deviceToken' => $this->deviceToken,
        ];

        return array_filter(
            $userData,
            function ($propertyValue, $propertyName){
                return $propertyValue !== null;
            },
            ARRAY_FILTER_USE_BOTH
        );
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
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
    public function getBirthDay(): string
    {
        return $this->birthDay;
    }

    /**
     * @return string
     */
    public function getNationality(): string
    {
        return $this->nationality;
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
     * @return string
     */
    public function getDateSigned(): string
    {
        return $this->dateSigned;
    }

    /**
     * @return string
     */
    public function getDeviceToken(): string
    {
        return $this->deviceToken;
    }

    /**
     * @return array
     */
    public function getWalletOrganizations(): array
    {
        return $this->walletOrganizations;
    }

    /**
     * @inheritDoc
     */
    public function setWalletOrganizations(
        array $organizations
    ): UserEntityInterface
    {
        $this->walletOrganizations = $organizations;
        return $this;
    }


}
