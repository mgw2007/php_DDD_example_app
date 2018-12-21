<?php

namespace Item\Application\CQRS\Command\Handler;


use Assert\Assertion;
use Item\Application\CQRS\Command\CommandHandlerInterface;
use Item\Application\CQRS\Command\CommandInterface;
use Item\Domain\Model\Item\ItemRepositoryInterface;

class ItemRateHandler implements CommandHandlerInterface
{
    private $repository;

    public function __construct(ItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function handle(CommandInterface $command)
    {
        $item = $this->repository->getOneByItemId($command->getItemId());
        Assertion::notEmpty($item,'Item not exist');
        $this->repository->rate($item,$command->getRating());
    }
}