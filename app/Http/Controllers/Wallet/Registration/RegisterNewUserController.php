<?php


namespace App\Http\Controllers\Wallet\Registration;

use App\Http\Controllers\Wallet\Account\Mapper\AccountMapper;
use App\Http\Controllers\Wallet\Account\Mapper\AccountMapperInterface;
use App\Rules\User\UserEmailRule;
use App\Rules\User\UserMobileNumberRule;
use App\Rules\Wallet\WalletUserIdRule;
use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Wallet\Wallet\Account\Entity\AccountEntity;
use Wallet\Wallet\Account\Service\AccountService;
use Wallet\Wallet\Account\Service\AccountServiceInterface;
use Wallet\Wallet\Account\Service\Exception\AccountNotFoundException;
use Wallet\Wallet\User\Entity\UserEntity;
use Wallet\Wallet\User\Service\Authentification\AuthenticationServiceInterface;
use Wallet\Wallet\User\Service\Exception\UserNotFoundException;
use Wallet\Wallet\User\Service\UserServiceInterface;

class RegisterNewUserController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var AuthenticationServiceInterface
     */
    private $userAuthenticationService;

    /**
     * @var AccountServiceInterface
     */
    private $accountService;

    /**
     * @var AccountMapperInterface
     */
    private $accountMapper;


    /**
     * RegisterNewUserController constructor.
     * @param UserServiceInterface $userService
     * @param AuthenticationServiceInterface $userAuthenticationService
     * @param AccountService $accountService
     * @param AccountMapper $accountMapper
     */
    public function __construct(
        UserServiceInterface $userService,
        AuthenticationServiceInterface $userAuthenticationService,
        AccountService $accountService,
        AccountMapper $accountMapper

    )
    {
        $this->userService = $userService;
        $this->userAuthenticationService = $userAuthenticationService;
        $this->accountService = $accountService;
        $this->accountMapper = $accountMapper;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(
        Request $request
    )
    {

        $validator = Validator::make(
            $request->json()->all(),
            [
                'firstName' => ['required', 'string'],
                'lastName' => ['required', 'string'],
                //'email' => ['required', 'email'],
               'email' => ['required', 'email', app(UserEmailRule::class)],
                'password' => ['required', 'string'],
                'mobileNumber' => [
                    'required',
                    'string',
                    'regex:/^([0-9\s\-\+\(\)]*)$/','min:10',
                    app(UserMobileNumberRule::class)
                ],
                'address.streetName' => ['required', 'string'],
                'address.streetNumber' => ['required', 'string'],
                'address.city' => ['required', 'string'],
                'address.postCode' => ['required', 'string'],
                'address.state' => ['required', 'string'],
                'address.country' => ['required', 'string'],
                'language' => ['required', 'string'],
                'group' => ['required', 'string'],
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => 0000,
                    'StatusDescription' => $validator->errors()
                ]
            );
        }

        try{
            $address = $request->json()->get('address');
            $userEntity = $this
                ->userService
                ->create(
                    UserEntity::fromArray(
                        [
                            "email" => $request->get('email'),
                            "firstName" => $request->get('firstName'),
                            "lastName" => $request->get('lastName'),
                            "address" => [
                                "streetName" => $address['streetName'],
                                "streetNumber" => $address['streetNumber'],
                                "city"=> $address['city'],
                                "postCode"=> $address['postCode'],
                                "state"=> $address['state'],
                                "country"=> $address['country']
                            ],
                            "mobileNumber" => $request->get('mobileNumber'),
                            "language" => $request->get('language'),
                            "walletOrganizations" => $request->get('ApiConsumer')->getOrganizations()
                        ]
                    ),
                    $request->get('ApiConsumer')->getOrganizations()
                );

            $this
                ->userAuthenticationService
                ->register(
                    $request->get('email'),
                    $request->get('password'),
                    $request->get('email'),
                    $request->get('mobileNumber'),
                    $userEntity->getUserId()
                )->addUserToGroup(
                    $request->get('email'),
                    $request->get('group')
                );


            $accountEntity = $this->accountService->create(
                AccountEntity::fromArray(
                    [
                        'accountType' => "personal",
                        'walletPlanId'=> "5ff742fb98f1c543604f391d",
                        'name'=> "Main Account",
                    ]
                ),
                $userEntity->getUserId(),
                $request->get('ApiConsumer')->getOrganizations()
            );
        } catch (UserNotFoundException $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $exception->getCode(),
                    'StatusDescription' => $exception->getMessage()
                ], 404
            );
        } catch(CognitoIdentityProviderException $c) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $c->getStatusCode(),
                    'StatusDescription' => $c->getAwsErrorMessage()
                ], 404
            );
        } catch(AccountNotFoundException $c) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $c->getStatusCode(),
                    'StatusDescription' => $c->getAwsErrorMessage()
                ], 404
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'data'=> [
                    'walletAccountUser'=> $userEntity->toArray()
                ]
            ]
        );
    }
}
