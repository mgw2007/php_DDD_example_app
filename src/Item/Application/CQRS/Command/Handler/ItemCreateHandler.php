<?php

namespace Item\Application\CQRS\Command\Handler;


use Item\Application\CQRS\Command\CommandHandlerInterface;
use Item\Application\CQRS\Command\CommandInterface;
use Item\Domain\Model\Item\ItemRepositoryInterface;

class ItemCreateHandler implements CommandHandlerInterface
{
    private $repository;

    public function __construct(ItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function handle(CommandInterface $command)
    {
        $this->repository->create($command->getItem());
    }
}