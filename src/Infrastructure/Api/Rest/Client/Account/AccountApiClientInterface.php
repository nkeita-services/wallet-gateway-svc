<?php

namespace Infrastructure\Api\Rest\Client\Account;

use Wallet\Account\Entity\AccountEntityInterface;

interface AccountApiClientInterface
{

    /**
     * @param array $accountPayload
     * @return AccountEntityInterface
     */
    public function create(array $accountPayload): AccountEntityInterface;
}
