<?php


namespace App\Http\Controllers\Wallet\User\Mapper;

use Illuminate\Http\Request;
use Wallet\Wallet\User\Entity\UserEntityInterface;

interface UserMapperInterface
{

    /**
     * @param Request $request
     * @return UserEntityInterface
     */
    public static function createUserFromHttpRequest(Request $request):UserEntityInterface;
}
