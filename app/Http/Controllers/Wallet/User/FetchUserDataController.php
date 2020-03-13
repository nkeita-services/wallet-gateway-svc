<?php


namespace App\Http\Controllers\Wallet\User;

use App\Http\Controllers\Controller;
use Wallet\Wallet\User\Service\UserService;
use Wallet\Wallet\User\Service\UserServiceInterface;

class FetchUserDataController extends Controller
{

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * FetchUserDataController constructor.
     * @param UserServiceInterface $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function fetch($userId)
    {
        return response()->json(
            $this->userService->fetch($userId)->toArray()
        );
    }
}
