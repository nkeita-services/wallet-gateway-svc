<?php


namespace Wallet\Wallet\User\Collection;



interface UserCollectionInterface
{
    /**
     * @param array $users
     * @return UserCollectionInterface
     */
    public static function fromArray(array $users):UserCollectionInterface;

    /**
     * @return array
     */
    public function toArray(): array ;
}
