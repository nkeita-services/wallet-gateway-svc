<?php


namespace Infrastructure\Api\Auth\OAuth2;


interface ClientInterface
{

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @return string
     */
    public function accessTokenFromClientIdAndSecret(
        string $clientId,
        string $clientSecret
    ):string;
}
