<?php

namespace Item\Infrastructure\Api\Controller;

use Item\Application\CommandHandlerInterface;
use Item\Application\CQRS\Command\Commands\ItemCreateCommand;
use Item\Application\CQRS\Command\Commands\ItemDeleteCommand;
use Item\Application\CQRS\Command\Commands\ItemRateCommand;
use Item\Application\CQRS\Command\Commands\ItemUpdateCommand;
use Item\Application\CQRS\Command\Handler\ItemCreateHandler;
use Item\Application\CQRS\Command\Handler\ItemDeleteHandler;
use Item\Domain\Model\Item\ItemRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class ItemRate extends Controller
{


    public function execute($paramters): Response
    {
        /* @var ItemRepositoryInterface $repository */
        $repository = $this->containerBuilder->get('itemRepository');

        /* @var ItemDeleteHandler $handler */
        $handler = $this->containerBuilder->get('command.itemRateHandler');
        $requestData = json_decode($this->request->getContent(), true);
        $command = new ItemRateCommand($paramters['id'],$requestData);
        $handler->handle($command);
        return new JsonResponse(['success' => "true"]);
    }

}