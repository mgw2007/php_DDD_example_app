<?php

namespace Item\Infrastructure\Api\Controller;

use Item\Application\CommandHandlerInterface;
use Item\Application\CQRS\Command\Commands\ItemCreateCommand;
use Item\Application\CQRS\Command\Handler\ItemCreateHandler;
use Item\Domain\Model\Item\ItemRepositoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class ItemCreate extends Controller
{


    public function execute($paramters): Response
    {
        /* @var ItemRepositoryInterface $repository */
        $repository = $this->containerBuilder->get('itemRepository');

        /* @var ItemCreateHandler $handler */
        $handler = $this->containerBuilder->get('command.itemCreateHandler');
        $requestData = json_decode($this->request->getContent(), true);
        $id = (string)$repository->nextIdentity();
        $command = new ItemCreateCommand($id, $requestData);
        $handler->handle($command);
        return new RedirectResponse('/items/' . $id);
    }

}