<?php


namespace Wallet\Wallet\User\Collection;


use Wallet\User\Entity\UserEntity;
use Wallet\User\Entity\UserEntityInterface;

class UserCollection implements UserCollectionInterface
{

    private $entities;

    /**
     * PlanCollection constructor.
     * @param $entities
     */
    public function __construct($entities)
    {
        $this->entities = $entities;
    }

    /**
     * @inheritDoc
     */
    public static function fromArray(array $users): UserCollectionInterface
    {
        return new static(
            array_map(function (array $user){
                return \Wallet\User\Entity\UserEntity::fromArray($user);
            },$users)
        );
    }

    /**UserCollection
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_map(function (UserEntityInterface $userEntity){
            return $userEntity->toArray();
        },$this->entities);
    }
}
