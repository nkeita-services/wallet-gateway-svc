<?php


namespace Wallet\Wallet\User\Service\Authentification;


interface AuthenticationServiceInterface
{

    /**
     * @param string $username
     * @param string $password
     * @param string $email
     * @param string $mobileNumber
     * @param string $userId
     * @return AuthenticationServiceInterface
     */
    public function register(
        string $username,
        string $password,
        string $email,
        string $mobileNumber,
        string $userId
    );

    /**
     * @param string $username
     * @param string $groupName
     * @return AuthenticationServiceInterface
     */
    public function addUserToGroup(
        string $username,
        string $groupName
    );

    /**
     * @param string $username
     * @param string $password
     * @return mixed
     */
    public function authenticate(
        string $username,
        string $password
    );

    /**
     * @param string $username
     * @param string $code
     * @return mixed
     */
    public function confirmRegistration(
        string $username,
        string $code
    );

    /**
     * @param string $accessToken
     * @return mixed
     */
    public function getUser(
        string $accessToken
    );

    /**
     * @inheritDoc
     */
    public function updateUserAttributes(
        string $userId,
        string $accessToken
    );



}
