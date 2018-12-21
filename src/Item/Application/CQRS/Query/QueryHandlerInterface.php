<?php

namespace Item\Application\CQRS\Query;


interface QueryHandlerInterface
{
    public function query(QueryInterface $query);
}