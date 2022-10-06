<?php


namespace App\Rules\User;

use Exception;
use Illuminate\Contracts\Validation\Rule;
use Wallet\Wallet\User\Service\Exception\UserNotFoundException;
use Wallet\Wallet\User\Service\UserServiceInterface;

class UserEmailRule implements Rule
{
    /**
     * @var UserServiceInterface
     */
    private $walletUserService;

    /**
     * WalletUserIdRule constructor.
     * @param UserServiceInterface $walletUserService
     */
    public function __construct(UserServiceInterface $walletUserService)
    {
        $this->walletUserService = $walletUserService;
    }

    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {

        try {
            $this
                ->walletUserService
                ->fetchByEmail(
                    $value
                );
            $emailNotExist = false;
        } catch (UserNotFoundException | Exception $e) {
            $emailNotExist = true;
        }
        return $emailNotExist;
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        return ":A user with this email already exist";
    }
}
