<?php


namespace Wallet\Wallet\User\Service\Authentification;

use Exception;
use Aws\Result;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;
use Infrastructure\Api\Consumer\Authorization\OpenID\Client;
use Wallet\Wallet\Document\Service\ComplianceServiceInterface;
use Wallet\Wallet\User\Entity\AwsRequestEntityInterface;
use Aws\Pinpoint\PinpointClient;
use Wallet\Wallet\User\Service\Exception\UserNotFoundException;
use Wallet\Wallet\User\Service\UserServiceInterface;


class AuthenticationService implements AuthenticationServiceInterface
{

    /**
     * Constant representing the not authorized exception.
     *
     * @var string
     */
    const COGNITO_NOT_AUTHORIZED_ERROR = 'NotAuthorizedException';

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
     * @var bool
     */
    protected $boolClientSecret;

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
     * @param bool $boolClientSecret
     * @param UserServiceInterface $userService
     * @param ComplianceServiceInterface $complianceService
     */
    public function __construct(
        CognitoIdentityProviderClient $cognitoIdentityProviderClient,
        PinpointClient $pinpointClientClient,
        string $clientId,
        string $userPoolId,
        bool $boolClientSecret,
        UserServiceInterface $userService,
        ComplianceServiceInterface $complianceService
    ) {
        $this->cognitoIdentityProviderClient = $cognitoIdentityProviderClient;
        $this->pinpointClientClient = $pinpointClientClient;
        $this->clientId = $clientId;
        $this->userPoolId = $userPoolId;
        $this->boolClientSecret = $boolClientSecret;
        $this->userService = $userService;
        $this->complianceService = $complianceService;
    }

    /**
     * Creates a HMAC from a string.
     *
     * @param string $message
     * @return string
     */
    protected function hash($message)
    {
        $hash = hash_hmac(
            'sha256',
            $message,
            "",
            true
        );

        return base64_encode($hash);
    }


    /**
     * Creates the Cognito secret hash.
     * @param string $username
     * @return string
     */
    protected function cognitoSecretHash($username)
    {
        return $this->hash($username . $this->clientId);
    }


    /*** @inheritDoc */
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

    /*** @inheritDoc */
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
     * @param Result $result
     * @return array
     * @throws Exception
     */
    public function formatAuthResult(Result $result): array
    {
        try {
            if (
                $result->hasKey('AuthenticationResult') &&
                isset($result->get('AuthenticationResult')['AccessToken'])
            ) {
                $userData = array_filter($this->getUser(
                    $result->get('AuthenticationResult')['AccessToken']
                ), function($value, $k) {
                    return $value['Name'] == 'custom:userId';
                }, ARRAY_FILTER_USE_BOTH);

                $userData = current($userData);
                $userId = isset($userData['Value']) ? $userData['Value'] : "";

                try {
                    $notification = $this
                        ->userService
                        ->fetch($userId)
                        ->getNotification();
                } catch (UserNotFoundException $exception) {
                    $notification = [];
                }

                return array_merge(
                    $result->get('AuthenticationResult'),
                    [
                        'userId' =>  $userId,
                        'notification' => $notification,
                        'UserKycDetails' => $this->complianceService->getUserKyc(
                            $userId
                        )
                    ]
                );
            }
        } catch (Exception $e) {
            throw $e;
        }

        return [];
    }

    /*** @inheritDoc */
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
                    'ClientId' => $this->clientId,
                    'UserPoolId' => $this->userPoolId
                ]);

            return $this->formatAuthResult($result);
        } catch (CognitoIdentityProviderException $exception) {
            throw $exception;
        } catch (UserNotFoundException $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'statusCode' => $exception->getCode(),
                    'statusDescription' => $exception->getMessage()
                ], 404
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'statusCode' => $e->getCode(),
                    'statusDescription' => $e->getMessage()
                ], 404
            );
        }
    }



    /*** @inheritDoc
     * @throws Exception
     */
    public function refreshTokenAuth(
        string $refreshToken
    ) {
        try {
            $result = $this
                ->cognitoIdentityProviderClient
                ->adminInitiateAuth([
                    'AuthFlow' => 'REFRESH_TOKEN_AUTH',
                    'AuthParameters' => [
                        'REFRESH_TOKEN' => $refreshToken
                    ],
                    'ClientId' => $this->clientId,
                    'UserPoolId' => $this->userPoolId,
                ]);

            // Reuse same refreshToken
            $result['AuthenticationResult']['RefreshToken'] = $refreshToken;

            return $this->formatAuthResult($result);
        } catch (CognitoIdentityProviderException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /*** @inheritDoc
     * @throws Exception
     */
    public function signOut(string $accessToken) {
        try {
            $this->cognitoIdentityProviderClient->globalSignOut([
                'AccessToken' => $accessToken
            ]);

        } catch (CognitoIdentityProviderException $e) {
            if ($e->getAwsErrorCode() === self::COGNITO_NOT_AUTHORIZED_ERROR) {
                return true;
            }

            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /*** @inheritDoc */
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

    /*** @inheritDoc */
    public function getAdminGetUser(string $username)
    {
        $result = $this
            ->cognitoIdentityProviderClient
            ->adminGetUser([
                'Username' => $username,
                'UserPoolId' => $this->userPoolId,
            ]);

        return $result;
    }



    /*** @inheritDoc */
    public function getUser(string $accessToken)
    {
        $result = $this
            ->cognitoIdentityProviderClient
            ->getUser([
                'AccessToken' => $accessToken
            ]);

        return $result->get('UserAttributes');
    }

    /*** @inheritDoc */
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

    /*** @inheritDoc */
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

    /*** @inheritDoc */
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

    /*** @inheritDoc */
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

    /*** @inheritDoc */
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

    /*** @inheritDoc */
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

    /*** @inheritDoc */
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
