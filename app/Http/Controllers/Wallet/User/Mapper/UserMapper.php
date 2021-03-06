<?php


namespace App\Http\Controllers\Wallet\User\Mapper;


use Illuminate\Http\Request;
use Wallet\User\Entity\UserEntity;
use Wallet\User\Entity\UserEntityInterface;

class UserMapper implements UserMapperInterface
{

    /**
     * @inheritDoc
     */
    public static function createUserFromHttpRequest(Request $request): UserEntityInterface
    {
        $payload =  $request->json()->all();

        return new UserEntity(
            $payload['lastName'],
            $payload['firstName'],
            $payload['address'],
            $payload['email'],
            $payload['phoneNumber'],
            $payload['mobileNumber'],
            $payload['language']
        );
    }
}
