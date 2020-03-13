<?php


namespace App\Http\Controllers\Wallet\User\Mapper;

use Laravel\Lumen\Http\Request;
use Wallet\User\Entity\UserEntityInterface;

interface UserMapperInterface
{

    /**
     * @param Request $request
     * @return UserEntityInterface
     */
    public static function createUserFromHttpRequest(Request $request):UserEntityInterface;
}
