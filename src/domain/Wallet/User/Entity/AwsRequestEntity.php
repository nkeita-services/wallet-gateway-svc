<?php


namespace Wallet\Wallet\User\Entity;


class AwsRequestEntity implements AwsRequestEntityInterface
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private  $username;

    /**
     * @var string
     */
    private  $userId;

    /**
     * @var string
     */
    private  $password;

    /**
     * @var string
     */
    private  $phoneNumber;

    /**
     * @var string
     */
    private  $userCode;

    /**
     * @var string
     */
    private  $accessToken;

    /**
     * @var string
     */
    private  $challengeName;

    /**
     * @var string
     */
    private  $session;

    /**
     * @var string
     */
    private  $confirmationCode;

    /**
     * @var string
     */
    private  $previousPassword;

    /**
     * @var string
     */
    private  $proposedPassword;

    /**
     * AwsRequestEntity constructor.
     * @param string|null $email
     * @param string|null $username
     * @param string|null $userId
     * @param string|null $password
     * @param string|null $phoneNumber
     * @param string|null $userCode
     * @param string|null $accessToken
     * @param string|null $challengeName
     * @param string|null $session
     * @param string|null $confirmationCode
     * @param string|null $previousPassword
     * @param string|null $proposedPassword
     */
    public function __construct(
        ?string $email,
        ?string $username,
        ?string $userId,
        ?string $password,
        ?string $phoneNumber,
        ?string $userCode,
        ?string $accessToken,
        ?string $challengeName,
        ?string $session,
        ?string $confirmationCode,
        ?string $previousPassword,
        ?string $proposedPassword
    ){
        $this->email = $email;
        $this->username = $username;
        $this->userId = $userId;
        $this->password = $password;
        $this->phoneNumber = $phoneNumber;
        $this->userCode = $userCode;
        $this->accessToken = $accessToken;
        $this->challengeName = $challengeName;
        $this->session = $session;
        $this->confirmationCode = $confirmationCode;
        $this->previousPassword = $previousPassword;
        $this->proposedPassword = $proposedPassword;
    }


    /**
     * @param array $data
     * @return AwsRequestEntityInterface
     */
    public static function fromArray(array $data): AwsRequestEntityInterface
    {
        return new static(
            $data['email'] ?? null,
            $data['username'] ?? null,
            $data['userId'] ?? null,
            $data['password'] ?? null,
            $data['phoneNumber'] ?? null,
            $data['userCode'] ?? null,
            $data['accessToken'] ?? null,
            $data['challengeName'] ?? null,
            $data['session'] ?? null,
            $data['confirmationCode'] ?? null,
            $data['previousPassword'] ?? null,
            $data['proposedPassword'] ?? null,
        );

    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'email' => $this->email,
            'username' => $this->username,
            'userId' => $this->userId,
            'password' => $this->password,
            'phoneNumber' => $this->phoneNumber,
            'userCode' => $this->userCode,
            'accessToken' => $this->accessToken,
            'challengeName' => $this->challengeName,
            'session' => $this->session,
            'confirmationCode' => $this->confirmationCode,
            'previousPassword' => $this->previousPassword,
            'proposedPassword' => $this->proposedPassword,
        ];

        return array_filter(
            $data,
            function ($propertyValue, $propertyName){
                return $propertyValue !== null;
            },
            ARRAY_FILTER_USE_BOTH
        );
    }

    /**
     * @inheritDoc
     */
    public function getEmail(): string
    {
        return trim(
            strtolower(
                $this->email
            )
        );

    }

    /**
     * @inheritDoc
     */
    public function getUsername(): string
    {
        return trim(
            strtolower(
                $this->username
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @inheritDoc
     */
    public function getPassword(): string
    {
        return trim($this->password);
    }

    /**
     * @inheritDoc
     */
    public function getPhoneNumber(): string
    {
        return trim(
            $this->phoneNumber
        );
    }

    /**
     * @inheritDoc
     */
    public function getUserCode(): string
    {
        return $this->userCode;
    }


    /**
     * @inheritDoc
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }


    /**
     * @inheritDoc
     */
    public function getChallengeName(): string
    {
        return $this->challengeName;
    }

    /**
     * @inheritDoc
     */
    public function getSession(): string
    {
        return $this->session;
    }

    /**
     * @inheritDoc
     */
    public function getConfirmationCode(): string
    {
        return $this->confirmationCode;
    }

    /**
     * @inheritDoc
     */
    public function getPreviousPassword(): string
    {
        return $this->previousPassword;
    }

    /**
     * @inheritDoc
     */
    public function getProposedPassword(): string
    {
        return $this->proposedPassword;
    }
}
