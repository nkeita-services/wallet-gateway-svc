<?php


namespace Wallet\Wallet\User\Service\Authentification;


use Wallet\Wallet\User\Entity\AwsRequestEntityInterface;

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
     * @param AwsRequestEntityInterface $awsRequestEntity
     * @return mixed
     */
    public function authenticate(
        AwsRequestEntityInterface $awsRequestEntity
    );

    /**
     * @param string $refreshToken
     * @return mixed
     */
    public function refreshTokenAuth(string $refreshToken);

    /**
     * @param string $accessToken
     * @return mixed
     */
    public function signOut(string $accessToken);

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
     * @param string $userId
     * @param string $accessToken
     * @return mixed
     */
    public function updateUserAttributes(
        string $userId,
        string $accessToken
    );

    /**
     * @param string $username
     * @return mixed
     */
    public function resendConfirmationCode(string $username);

    /**
     * @param string $username
     * @return mixed
     */
    public function forgotPassword(string $username);

    /**
     * @param string $username
     * @param string $password
     * @param string $confirmationCode
     * @return mixed
     *
     */
    public function confirmForgotPassword(
        string $username,
        string $password,
        string $confirmationCode
    );

    /**
     * @param string $accessToken
     * @param string $previousPassword
     * @param string $proposedPassword
     * @return mixed
     */
    public function changePassword(
        string $accessToken,
        string $previousPassword,
        string $proposedPassword
    );

    /**
     * @param string $userName
     * @return mixed
     */
    public function disableUser(string $userName);

    /**
     * @param string $userName
     * @return mixed
     */
    public function enableUser(string $userName);
}
