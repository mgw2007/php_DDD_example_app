<?php
require __DIR__."/../vendor/autoload.php";
//
//
//use Symfony\Component\DependencyInjection\ContainerBuilder;
//use Symfony\Component\DependencyInjection\Reference;
//
//
//use Item\Infrastructure\Persistence\InMemory\ItemInMemoryRepository;
//
//use Item\Application\CQRS\Command\Handler\ItemCreateHandler;
//use Item\Application\CQRS\Command\Handler\ItemUpdateHandler;
//use Item\Application\CQRS\Command\Handler\ItemDeleteHandler;
//use Item\Application\CQRS\Command\Handler\ItemRateHandler;
//use Item\Application\CQRS\Query\QueryHandler\ItemQueryOneHandler;
//use Item\Application\CQRS\Query\QueryHandler\ItemQueryAllHandler;
//
//class Bootsrap
//$containerBuilder = new ContainerBuilder();
//
//
//$containerBuilder->register('itemRepository', ItemInMemoryRepository::class);
//
//// add commands
//$containerBuilder->register('command.itemCreateHandler', ItemCreateHandler::class)->addArgument(new Reference('itemRepository'));
//$containerBuilder->register('command.itemUpdateHandler', ItemUpdateHandler::class)->addArgument(new Reference('itemRepository'));
//$containerBuilder->register('command.itemDeleteHandler', ItemDeleteHandler::class)->addArgument(new Reference('itemRepository'));
//$containerBuilder->register('command.itemRateHandler', ItemRateHandler::class)->addArgument(new Reference('itemRepository'));
//$containerBuilder->register('query.itemViewAllHandler', ItemQueryAllHandler::class)->addArgument(new Reference('itemRepository'));
//$containerBuilder->register('query.itemViewOneHandler', ItemQueryOneHandler::class)->addArgument(new Reference('itemRepository'));
//$containerBuilder->register('query.itemViewOneHandler', ItemQueryOneHandler::class)->addArgument(new Reference('itemRepository'));
//
//return $containerBuilder;
