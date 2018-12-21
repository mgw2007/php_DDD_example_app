<?php

namespace Item\Infrastructure\Api\User;


class User implements UserInterface
{
    public function checkAuthentication($token): void
    {
        //STATIC_TOKEN (can be returned from database)
        $staticToken = "your_secure_token";

        if ($token != $staticToken) {
            throw new NotAuthorizedException();
        }
    }

    public function getIsAuthenticated(): bool
    {
        return true;
    }
}