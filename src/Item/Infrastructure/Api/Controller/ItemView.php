<?php

namespace Item\Infrastructure\Api\Controller;

use Item\Application\CommandHandlerInterface;
use Item\Application\CQRS\Query\Queries\GetOneItemQuery;
use Item\Application\CQRS\Query\QueryHandlerInterface;
use Item\Domain\Model\Item\Item;
use Item\Domain\Model\Item\ItemRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ItemView extends Controller
{


    public function execute($paramters): Response
    {
        /* @var QueryHandlerInterface $queryHandler */
        $queryHandler = $this->containerBuilder->get('query.itemViewOneHandler');

        $query = new GetOneItemQuery($paramters['id']);
        $data = $queryHandler->query($query);
        /* @var Item $data */
        return new JsonResponse($data);
    }

}