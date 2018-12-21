<?php

use Item\Infrastructure\Api\Controller;

return [
    'items_add'      => [
        'path'       => '/items',
        'controller' => Controller\ItemCreate::class,
        'methods'    => ['POST'],
        'secure'    => true
    ],
    'items_update'   => [
        'path'       => '/items/{id}',
        'controller' => Controller\ItemUpdate::class,
        'methods'    => ['PUT', 'PATCH'],
        'secure'    => true
    ],
    'items_delete'   => [
        'path'       => '/items/{id}',
        'controller' => Controller\ItemDelete::class,
        'methods'    => ['DELETE'],
        'secure'    => true
    ],
    'items_rate'     => [
        'path'       => '/items/{id}/rate',
        'controller' => Controller\ItemRate::class,
        'methods'    => ['POST']
    ],
    'items_view_one' => [
        'path'       => '/items/{id}',
        'controller' => Controller\ItemView::class,
        'methods'    => ['GET']
    ],
    'items_view_all' => [
        'path'       => '/items',
        'controller' => Controller\ItemViewAll::class,
        'methods'    => ['GET']
    ]
];