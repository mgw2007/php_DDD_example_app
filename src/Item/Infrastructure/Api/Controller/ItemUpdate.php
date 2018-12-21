<?php

namespace Item\Infrastructure\Api\Controller;

use Item\Application\CommandHandlerInterface;
use Item\Application\CQRS\Command\Commands\ItemUpdateCommand;
use Item\Application\CQRS\Command\Handler\ItemUpdateHandler;
use Item\Domain\Model\Item\ItemRepositoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class ItemUpdate extends Controller
{


    public function execute($paramters): Response
    {
        /* @var ItemRepositoryInterface $repository */
        $repository = $this->containerBuilder->get('itemRepository');

        /* @var ItemUpdateHandler $handler */
        $handler = $this->containerBuilder->get('command.itemUpdateHandler');
        $id = (string)$paramters['id'];
        $requestData = json_decode($this->request->getContent(), true);
        $command = new ItemUpdateCommand($id, $requestData);
        $handler->handle($command);
        return new RedirectResponse('/items/' . $paramters['id']);
    }

}