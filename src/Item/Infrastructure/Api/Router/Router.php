<?php

namespace Item\Infrastructure\Api\Router;


class Router implements RouterInterface
{
    protected $parameters;
    protected $controllerName;

    public function __construct(string $controllerName, array $params)
    {
        $this->parameters = $params;
        $this->controllerName = $controllerName;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }


    public function getControllerName(): string
    {
        return $this->controllerName;

    }

}