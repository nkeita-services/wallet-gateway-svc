<?php


namespace Wallet\Wallet\User\Service\Authentification;


use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Illuminate\Support\Arr;

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
    public function register(
        string $username,
        string $password,
        string $email,
        string $mobileNumber,
        string $userId
    ){
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
                        ],
                        [
                            'Name' => 'phone_number',
                            'Value' => $mobileNumber
                        ],
                        [
                            'Name' => 'custom:userId',
                            'Value' => $userId
                        ],
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
       /* $username = 'mkeita@hakili.io';
        $password= 'M0oiuyt12@uiU';*/

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

        $userData = array_filter($this->getUser(
            $result->get('AuthenticationResult')['AccessToken']
        ), function($value, $k) {
            return $value['Name'] == 'custom:userId';
        }, ARRAY_FILTER_USE_BOTH);

        $userData = current($userData);

       return array_merge(
           $result->get('AuthenticationResult'),
           [ 'userId' =>  isset($userData['Value']) ? $userData['Value'] : "" ]
       );
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

    /**
     * @inheritDoc
     */
    public function getUser(string $accessToken)
    {
        $result = $this
            ->cognitoIdentityProviderClient
            ->getUser([
                'AccessToken' => $accessToken
            ]);

        return $result->get('UserAttributes');
    }

    /**
     * @inheritDoc
     */
    public function updateUserAttributes(string $userId, string $accessToken)
    {
        $result = $this
            ->cognitoIdentityProviderClient
            ->updateUserAttributes([
                    'AccessToken' => $accessToken,
                    'UserAttributes' => [
                        [
                            'Name' => 'userId',
                            'Value' => $userId
                        ]
                    ],
            ]
            );
    }
}
