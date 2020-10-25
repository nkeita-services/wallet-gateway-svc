<?php


namespace Wallet\Wallet\User\Service\Authentification;


interface AuthenticationServiceInterface
{

    /**
     * @param string $username
     * @param string $password
     * @param string $email
     * @return AuthenticationServiceInterface
     */
    public function register(
        string $username,
        string $password,
        string $email
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
}
