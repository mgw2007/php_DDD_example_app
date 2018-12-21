<?php

namespace Item\Infrastructure\Api\Router;

use Symfony\Component\HttpFoundation\Request;

interface RouterServiceInterface
{
    function __construct(Routes $routes);

    function getRouter(Request $request): RouterInterface;
}