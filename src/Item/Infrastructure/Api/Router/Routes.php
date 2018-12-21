<?php

namespace Item\Infrastructure\Api\Router;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

class Routes implements RoutesInterface
{
    private $routesCollection = [];

    public function __construct(RouteCollection $routeCollection)
    {
        $this->routesCollection = $routeCollection;
    }

    public function getRouteCollection(): RouteCollection
    {
        return $this->routesCollection;
    }

    public function add(String $routeName, Route $route): void
    {
        $this->routesCollection->add($routeName, $route);
    }

}