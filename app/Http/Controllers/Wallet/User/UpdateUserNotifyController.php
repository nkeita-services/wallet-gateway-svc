<?php


namespace App\Http\Controllers\Wallet\User;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Wallet\User\Mapper\UserMapper;
use App\Http\Controllers\Wallet\User\Mapper\UserMapperInterface;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Wallet\Wallet\User\Service\Exception\UserNotFoundException;
use Wallet\Wallet\User\Service\UserService;
use Wallet\Wallet\User\Service\UserServiceInterface;

class UpdateUserNotifyController extends Controller
{
    /**
     * @var UserMapperInterface
     */
    private $userMapper;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * CreateUserController constructor.
     * @param UserMapper $userMapper
     * @param UserService $userService
     */
    public function __construct(
        UserMapper $userMapper,
        UserService $userService
    ) {
        $this->userMapper = $userMapper;
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @param string $userId
     * @return JsonResponse
     */
    public function updateNotify(Request $request, string $userId)
    {
        $validator = Validator::make(
            $request->json()->all(),
            [
                'notify' => ['required', 'boolean'],
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'statusCode' => 0000,
                    'statusDescription' => $validator->errors()
                ]
            );
        }

        $deviceToken = $request->get('deviceToken', "");
        $deviceOs = $request->get('deviceOs', "");

        $userEntity = $this->userService->fetch($userId);

        $userEntity->setNotification(
            [
                'notify' => $request->get('notify', false),
                'date' => Carbon::now()->format('Y/m/d H:i:s')
            ]
        );

        if( $deviceToken && $deviceOs) {
            $userEntity->setDevice([
                [
                    'deviceToken' => $deviceToken,
                    'deviceOs' => $deviceOs
                ]
            ]);
        }

        try {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => [
                        'walletAccountUser' => $this->userService->update(
                            $userId,
                            $userEntity->toArray()
                        )->toArray()
                    ]
                ]
            );

        } catch (UserNotFoundException $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'statusCode' => $exception->getCode(),
                    'statusDescription' => $exception->getMessage()
                ], 404
            );
        }
    }
}
