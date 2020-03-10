<?php

namespace Infrastructure\Api\Rest\Client\Account;

interface AccountApiClientInterface
{

    public function create(array $accountPayload);
}
