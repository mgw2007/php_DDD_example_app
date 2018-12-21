<?php

namespace Item\Infrastructure\Api\Controller;

use Item\Application\CommandHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerBuilder;

abstract class Controller implements ControllerInterface
{
    /**
     * @var ContainerBuilder
     */
    protected $containerBuilder;

    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request, ContainerBuilder $containerBuilder)
    {
        $this->containerBuilder = $containerBuilder;
        $this->request =  $request;
    }
}