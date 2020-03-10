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
     * UserEntity constructor.
     * @param string $lastName
     * @param string $firstName
     * @param array $address
     * @param string $email
     * @param string $phoneNumber
     * @param string $mobileNumber
     * @param string $language
     */
    public function __construct(
        string $lastName,
        string $firstName,
        array $address,
        string $email,
        string $phoneNumber,
        string $mobileNumber,
        string $language
    ){
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->address = $address;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->mobileNumber = $mobileNumber;
        $this->language = $language;
    }


}
