<?php

namespace Item\Application\CQRS\Command;


interface CommandHandlerInterface
{
    public function handle(CommandInterface $command);
}