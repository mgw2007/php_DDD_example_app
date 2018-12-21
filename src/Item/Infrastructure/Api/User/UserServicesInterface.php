<?php

namespace Item\Infrastructure\Api\User;

use Item\Infrastructure\Api\Router\RouterInterface;
use Symfony\Component\HttpFoundation\Request;

interface UserServicesInterface
{
    public function __construct(UserInterface $user, Request $request);

    public function checkRouteAuthentication(RouterInterface $router);
}