<?php


namespace App\Http\Controllers\Wallet\User\Mapper;


use Illuminate\Http\Request;
use Carbon\Carbon;
use Wallet\Wallet\User\Entity\UserEntity;
use Wallet\Wallet\User\Entity\UserEntityInterface;

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
            $payload['phoneNumber'] ?? null,
            $payload['mobileNumber'],
            $payload['language'],
            Carbon::now()->format('Y/m/d H:i:s'),
            $payload['device'] ?? [],
            $payload['notification'] ?? [],
            $request->get('ApiConsumer')->getOrganizations(),
            $payload['userId'] ?? null,
            $payload['createdAt'] ?? null,
            $payload['status'] "active"

        );
    }
}
