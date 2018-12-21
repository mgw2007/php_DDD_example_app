<?php

namespace Item\Infrastructure\Api\Controller;

use Item\Application\CommandHandlerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerBuilder;


interface ControllerInterface
{
    public function __construct(Request $request, ContainerBuilder $containerBuilder);

    public function execute($parameters): Response;
}