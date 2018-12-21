<?php

namespace Item\Infrastructure\Api\Router;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

interface RoutesInterface
{
    public function __construct(RouteCollection $routeCollection);

    public function getRouteCollection(): RouteCollection;

    public function add(String $routeName, Route $route): void;
}