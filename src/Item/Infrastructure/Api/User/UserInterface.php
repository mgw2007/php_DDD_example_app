<?php

namespace Item\Infrastructure\Api\User;

interface UserInterface
{
    public function checkAuthentication($token): void;

    public function getIsAuthenticated(): bool;
}