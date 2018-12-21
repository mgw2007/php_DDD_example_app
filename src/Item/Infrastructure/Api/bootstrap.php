<?php


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Routing\Route as SymfonyRoute;
use Symfony\Component\Routing\Exception\ExceptionInterface;
use Symfony\Component\HttpFoundation\Request;

use Item\Infrastructure\Api\Router\Route;

use Item\Infrastructure\Persistence\Doctrine\ItemRepository;
use Item\Application\CQRS\Command\Handler\ItemCreateHandler;
use Item\Application\CQRS\Command\Handler\ItemUpdateHandler;
use Item\Application\CQRS\Command\Handler\ItemDeleteHandler;
use Item\Application\CQRS\Command\Handler\ItemRateHandler;
use Item\Application\CQRS\Query\QueryHandler\ItemQueryOneHandler;
use Item\Application\CQRS\Query\QueryHandler\ItemQueryAllHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Item\Infrastructure\Api\User\NotAuthorizedException;
use Item\Infrastructure\Persistence\EntityManagerFactory;

$currentRequest = Request::createFromGlobals();
$containerBuilder = new ContainerBuilder();

$conn = require 'config/db.php';
$entityManager = EntityManagerFactory::createEntityManager($conn);
$containerBuilder->set('entityManager', $entityManager);

$containerBuilder->register('itemRepository', ItemRepository::class)->addArgument(new Reference('entityManager'))
    ->addArgument($entityManager->getClassMetadata(\Item\Infrastructure\Persistence\Doctrine\Item::class));

// add commands
$containerBuilder->register('command.itemCreateHandler', ItemCreateHandler::class)->addArgument(new Reference('itemRepository'));
$containerBuilder->register('command.itemUpdateHandler', ItemUpdateHandler::class)->addArgument(new Reference('itemRepository'));
$containerBuilder->register('command.itemDeleteHandler', ItemDeleteHandler::class)->addArgument(new Reference('itemRepository'));
$containerBuilder->register('command.itemRateHandler', ItemRateHandler::class)->addArgument(new Reference('itemRepository'));
$containerBuilder->register('query.itemViewAllHandler', ItemQueryAllHandler::class)->addArgument(new Reference('itemRepository'));
$containerBuilder->register('query.itemViewOneHandler', ItemQueryOneHandler::class)->addArgument(new Reference('itemRepository'));
$containerBuilder->register('query.itemViewOneHandler', ItemQueryOneHandler::class)->addArgument(new Reference('itemRepository'));

$containerBuilder->register('routes', \Item\Infrastructure\Api\Router\Routes::class)->addArgument(new RouteCollection());
//
////add Routes
$systemRoutes = require 'config/routes.php';
foreach ($systemRoutes as $routeName => $routeData) {
    $containerBuilder->get('routes')->add($routeName, new SymfonyRoute($routeData['path'], $routeData, [], [], '', [], $routeData['methods']));
}
$containerBuilder->register('routesService', \Item\Infrastructure\Api\Router\RouterService::class)->addArgument(new Reference('routes'));

$containerBuilder->register('loginUser', \Item\Infrastructure\Api\User\User::class);
$containerBuilder->register('userServices', \Item\Infrastructure\Api\User\UserServices::class)
    ->addArgument(new Reference('loginUser'))
    ->addArgument($currentRequest);

try {
    $currentRouter = $containerBuilder->get('routesService')->getRouter($currentRequest);
    //authorize
    $containerBuilder->get('userServices')->checkRouteAuthentication($currentRouter);
    /* @var \Item\Infrastructure\Api\Router\Router $currentRouter */
    $controllerClass = $currentRouter->getControllerName();
    $controller = new $controllerClass($currentRequest, $containerBuilder);
    /* @var \Item\Infrastructure\Api\Controller\ControllerInterface $controller */
    $controller->execute($currentRouter->getParameters())->send();
} catch (NotAuthorizedException $e) {
    $response = new Response('UnAuthorized', Response::HTTP_UNAUTHORIZED);
    $response->send();
} catch (ExceptionInterface $e) {
    $response = new JsonResponse(['error' => $e->getCode(), 'messsage' => 'Invalid Routing'], Response::HTTP_NOT_FOUND);
    $response->send();
} catch (Exception $e) {
    $response = new JsonResponse(['error' => $e->getCode(), 'messsage' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
    $response->send();
}
