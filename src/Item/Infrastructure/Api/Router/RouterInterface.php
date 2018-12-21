<?php

namespace Item\Infrastructure\Api\Router;


interface RouterInterface
{
    public function __construct(string $controllerName,array $params);

    function getParameters(): array;

    function getControllerName(): string ;

}