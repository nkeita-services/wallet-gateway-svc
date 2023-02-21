<?php


namespace Wallet\Wallet\User\Service\Authentification;

use Exception;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;
use Wallet\Wallet\Document\Service\ComplianceServiceInterface;
use Wallet\Wallet\User\Entity\AwsRequestEntityInterface;
use Aws\Pinpoint\PinpointClient;
use Wallet\Wallet\User\Service\Exception\UserNotFoundException;
use Wallet\Wallet\User\Service\UserServiceInterface;


class AuthenticationService implements AuthenticationServiceInterface
{

    /**
     * @var CognitoIdentityProviderClient
     */
    private $cognitoIdentityProviderClient;

    /**
     * @var PinpointClient
     */
    private $pinpointClientClient;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $userPoolId;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var ComplianceServiceInterface
     */
    private $complianceService;

    /**
     * AuthenticationService constructor.
     * @param CognitoIdentityProviderClient $cognitoIdentityProviderClient
     * @param PinpointClient $pinpointClientClient
     * @param string $clientId
     * @param string $userPoolId
     * @param UserServiceInterface $userService
     * @param ComplianceServiceInterface $complianceService
     */
    public function __construct(
        CognitoIdentityProviderClient $cognitoIdentityProviderClient,
        PinpointClient $pinpointClientClient,
        string $clientId,
        string $userPoolId,
        UserServiceInterface $userService,
        ComplianceServiceInterface $complianceService
    ) {
        $this->cognitoIdentityProviderClient = $cognitoIdentityProviderClient;
        $this->pinpointClientClient = $pinpointClientClient;
        $this->clientId = $clientId;
        $this->userPoolId = $userPoolId;
        $this->userService = $userService;
        $this->complianceService = $complianceService;
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
     * @throws Exception
     */
    public function authenticate(
        AwsRequestEntityInterface $awsRequestEntity
    ) {

        try {
            $result = $this
                ->cognitoIdentityProviderClient
                ->initiateAuth([
                    'AuthFlow' => 'USER_PASSWORD_AUTH',
                    'AuthParameters' => [
                        'USERNAME' => $awsRequestEntity->getEmail(),
                        'PASSWORD' => $awsRequestEntity->getPassword()
                    ],
                    'ClientId' => $this->clientId
                ]);

            if (
                $result->hasKey('AuthenticationResult') &&
                isset($result->get('AuthenticationResult')['AccessToken'])
            )
            {
                $userData = array_filter($this->getUser(
                    $result->get('AuthenticationResult')['AccessToken']
                ), function($value, $k) {
                    return $value['Name'] == 'custom:userId';
                }, ARRAY_FILTER_USE_BOTH);

                $userData = current($userData);

                $userId = isset($userData['Value']) ? $userData['Value'] : "";

                $userEntity = $this->userService->fetch($userId);



                return array_merge(
                    $result->get('AuthenticationResult'),
                    [
                        'userId' =>  $userId,
                        'notification' => $userEntity->getNotification(),
                        'UserKycDetails' => $this->complianceService->getUserKyc(
                            $userId
                        )
                    ]
                );
            }
        } catch (CognitoIdentityProviderException $exception) {
            throw $exception;
        } catch (UserNotFoundException $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $exception->getCode(),
                    'StatusDescription' => $exception->getMessage()
                ], 404
            );
        }

        return response()->json(
            [
                'status' => 'error',
                'StatusCode' => 500,
                'StatusDescription' => "Something wrong"
            ], 404
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

    /**
     * @param string $username
     * @return mixed
     */
    public function resendConfirmationCode(string $username)
    {
        try {
            $result = $this
                ->cognitoIdentityProviderClient
                ->resendConfirmationCode([
                        'ClientId' => $this->clientId,
                        'Username' => $username,

                    ]
                );
        } catch (CognitoIdentityProviderException $exception) {
            throw $exception;
        }
    }

    /**
     * @param string $username
     * @return mixed
     */
    public function forgotPassword(string $username)
    {
        try {
            $result = $this
                ->cognitoIdentityProviderClient
                ->forgotPassword([
                        'ClientId' => $this->clientId,
                        'Username' => $username,
                    ]
                );

            return $result->get('CodeDeliveryDetails');

        } catch (CognitoIdentityProviderException $exception) {
            throw $exception;
        }
    }

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
    ) {
        try {
            $result = $this
                ->cognitoIdentityProviderClient
                ->confirmForgotPassword([
                        'ClientId' => $this->clientId,
                        'ConfirmationCode' => $confirmationCode,
                        'Password' => $password,
                        'Username' => $username,

                    ]
                );
        } catch (CognitoIdentityProviderException $exception) {
            throw $exception;
        }
    }

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
    ) {
        try {
            $result = $this
                ->cognitoIdentityProviderClient
                ->changePassword([
                        'AccessToken' => $accessToken,
                        'PreviousPassword' => $previousPassword,
                        'ProposedPassword' => $proposedPassword,

                    ]
                );

        } catch (CognitoIdentityProviderException $exception) {
            throw $exception;
        }
    }

    /**
     * @param string $userName
     * @return mixed
     */
    public function disableUser(string $userName)
    {
        try {
            $result = $this
                ->cognitoIdentityProviderClient
                ->adminDisableUser([
                        'Username' => $userName,
                        'UserPoolId' => $this->userPoolId,
                    ]
                );

        } catch (CognitoIdentityProviderException $exception) {
            throw $exception;
        }
    }

    /**
     * @param string $userName
     * @return mixed
     */
    public function enableUser(string $userName)
    {
        try {
            $result = $this
                ->cognitoIdentityProviderClient
                ->adminEnableUser([
                        'Username' => $userName,
                        'UserPoolId' => $this->userPoolId,
                    ]
                );

        } catch (CognitoIdentityProviderException $exception) {
            throw $exception;
        }
    }
}
