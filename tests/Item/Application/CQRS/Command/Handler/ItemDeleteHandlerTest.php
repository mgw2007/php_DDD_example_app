<?php


use PHPUnit\Framework\TestCase;
use Item\Application\CQRS\Command\Commands\ItemCreateCommand;
use Item\Application\CQRS\Command\Commands\ItemDeleteCommand;
use Item\Application\CQRS\Command\Handler\ItemCreateHandler;
use Item\Application\CQRS\Command\Handler\ItemDeleteHandler;
use Item\Infrastructure\Persistence\InMemory\ItemInMemoryRepository;

class ItemDeleteHandlerTest extends TestCase
{
    /**
     * @var ItemInMemoryRepository
     */
    private $itemRepository;

    protected function setUp()
    {
        $this->itemRepository = new ItemInMemoryRepository();
    }

    public function testDeleteShouldFailedBecauseNotExistId()
    {
        $this->expectException(InvalidArgumentException::class);
        //save good item
        $id = $this->itemRepository->nextIdentity();
        $command = new ItemCreateCommand($id, [
            'name'       => 'goodName',
            'propTime'   => '20:00',
            'difficulty' => 1,
            'vegetarian' => false
        ]);
        $commandHandler = new ItemCreateHandler($this->itemRepository);
        $commandHandler->handle($command);

        $id2 = $this->itemRepository->nextIdentity();

        $command = new ItemDeleteCommand($id2);
        $commandHandler = new ItemDeleteHandler($this->itemRepository);
        $commandHandler->handle($command);
    }


    public function testDeleteShouldSuccess()
    {
        //save good item
        $id = $this->itemRepository->nextIdentity();
        $command = new ItemCreateCommand($id, [
            'name'       => 'goodName',
            'propTime'   => '20:00',
            'difficulty' => 1,
            'vegetarian' => false
        ]);
        $commandHandler = new ItemCreateHandler($this->itemRepository);
        $commandHandler->handle($command);


        $command = new ItemDeleteCommand($id);
        $commandHandler = new ItemDeleteHandler($this->itemRepository);
        $commandHandler->handle($command);

        $this->assertNull($this->itemRepository->getOneByItemId($id));
    }


}