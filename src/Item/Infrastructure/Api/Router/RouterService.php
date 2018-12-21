<?php

namespace Item\Infrastructure\Api\Router;

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;

class RouterService implements RouterServiceInterface
{
    public function __construct(Routes $routes)
    {
        $this->routes = $routes;

    }

    function getRouter(Request $request): RouterInterface
    {

        // Init RequestContext object
        $context = new RequestContext();
        $context->fromRequest($request);

        // Init UrlMatcher object
        $matcher = new UrlMatcher($this->routes->getRouteCollection(), $context);
        $parameters = $matcher->match($context->getPathInfo());
        //check authorization
        $request->attributes->add($parameters);
        return new Router($parameters['controller'], $parameters);
    }
}