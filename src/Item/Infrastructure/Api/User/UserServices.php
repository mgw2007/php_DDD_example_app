<?php

namespace Item\Infrastructure\Api\User;

use Item\Infrastructure\Api\Router\RouterInterface;
use Symfony\Component\HttpFoundation\Request;

class UserServices implements UserServicesInterface
{
    private $user;
    private $request;
    public function __construct(UserInterface $user, Request $request)
    {
        $this->user = $user;
        $this->request = $request;
    }

    function checkRouteAuthentication(RouterInterface $router)
    {
        $params = $router->getParameters();
        if (isset($params['secure']) && $params['secure']) {
            //check authorization

            $this->user->checkAuthentication($this->request->headers->get('Authorization'));
        }
    }
}