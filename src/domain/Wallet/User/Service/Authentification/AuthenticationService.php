<?php


namespace Wallet\Wallet\User\Service\Authentification;


use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;

class AuthenticationService implements AuthenticationServiceInterface
{

    /**
     * @var CognitoIdentityProviderClient
     */
    private $cognitoIdentityProviderClient;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $userPoolId;

    /**
     * AuthenticationService constructor.
     * @param CognitoIdentityProviderClient $cognitoIdentityProviderClient
     * @param string $clientId
     * @param string $userPoolId
     */
    public function __construct(
        CognitoIdentityProviderClient $cognitoIdentityProviderClient,
        string $clientId,
        string $userPoolId
    ){
        $this->cognitoIdentityProviderClient = $cognitoIdentityProviderClient;
        $this->clientId = $clientId;
        $this->userPoolId = $userPoolId;
    }


    /**
     * @inheritDoc
     */
    public function register(string $username, string $password, string $email)
    {
        $this
            ->cognitoIdentityProviderClient
            ->signUp(
                [
                    'ClientId' => $this->clientId,
                    'Username' => $username,
                    'Password' => $password,
                    "UserAttributes" => [
                        [
                            'Name' => 'email',
                            'Value' => $email
                        ]
                    ]
                ]
            );

        return $this;
    }


    /**
     * @inheritDoc
     */
    public function addUserToGroup(string $username, string $groupName)
    {
        $this
            ->cognitoIdentityProviderClient
            ->adminAddUserToGroup([
                'GroupName' => $groupName,
                'UserPoolId' => $this->userPoolId,
                'Username' => $username
            ]);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function authenticate(string $username, string $password)
    {
        $result = $this
            ->cognitoIdentityProviderClient
            ->initiateAuth([
                'AuthFlow' => 'USER_PASSWORD_AUTH',
                'AuthParameters' => [
                    'USERNAME' => $username,
                    'PASSWORD' => $password
                ],
                'ClientId' => $this->clientId
            ]);
    }


    /**
     * @inheritDoc
     */
    public function confirmRegistration(string $username, string $code)
    {
        $result = $this
            ->cognitoIdentityProviderClient
            ->confirmSignUp([
                    'ClientId' => $this->clientId,
                    'Username' => $username,
                    'ConfirmationCode' => $code,
                ]
            );

    }
}
