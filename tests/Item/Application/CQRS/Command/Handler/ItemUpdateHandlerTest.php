<?php


use PHPUnit\Framework\TestCase;
use Item\Application\CQRS\Command\Commands\ItemCreateCommand;
use Item\Application\CQRS\Command\Commands\ItemUpdateCommand;
use Item\Application\CQRS\Command\Handler\ItemCreateHandler;
use Item\Application\CQRS\Command\Handler\ItemUpdateHandler;
use Item\Infrastructure\Persistence\InMemory\ItemInMemoryRepository;

class ItemUpdateHandlerTest extends TestCase
{
    /**
     * @var ItemInMemoryRepository
     */
    private $itemRepository;

    protected function setUp()
    {
        $this->itemRepository = new ItemInMemoryRepository();
    }

    public function testUpdateShouldFailedBecauseNotExistId()
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

        $command = new ItemUpdateCommand($id2, [
            'name'       => 'goodName',
            'propTime'   => '20:00',
            'difficulty' => 1,
            'vegetarian' => true
        ]);
        $commandHandler = new ItemUpdateHandler($this->itemRepository);
        $commandHandler->handle($command);
    }




    /**
     * @dataProvider providerForFailed
     */
    public function testUpdateShouldFailedWrongData($name, $propTime, $difficulty, $vegetarian)
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


        $command = new ItemUpdateCommand($id, [
            'name'       => $name,
            'propTime'   => $propTime,
            'difficulty' => $difficulty,
            'vegetarian' => $vegetarian
        ]);
        $commandHandler = new ItemUpdateHandler($this->itemRepository);
        $commandHandler->handle($command);
    }

    public function providerForFailed()
    {
        return [
            [
                'name'       => 'name',
                'propTime'   => '01:00',
                'difficulty' => '1',
                'vegetarian' => 'notBool',
            ],
            ['name'       => 'name',
             'propTime'   => '91:00',
             'difficulty' => '1',
             'vegetarian' => true,
            ],
            [
                'name'       => 'name',
                'propTime'   => '01:00',
                'difficulty' => 'zz',
                'vegetarian' => true,
            ],
            ['name'       => 'name',
             'propTime'   => '66:00',
             'difficulty' => 'NotNumber',
             'vegetarian' => true,
            ],
            ['name'       => 'name',
             'propTime'   => '01:00',
             'difficulty' => '0',
             'vegetarian' => true,
            ],
            ['name'       => 'name',
             'propTime'   => '01:00',
             'difficulty' => '6',
             'vegetarian' => true,
            ],
        ];
    }

    /**
     * @dataProvider providerForSuccess
     */
    public function testUpdateShouldSuccess($name, $propTime, $difficulty, $vegetarian)
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


        $command = new ItemUpdateCommand($id, [
            'name'       => $name,
            'propTime'   => $propTime,
            'difficulty' => $difficulty,
            'vegetarian' => $vegetarian
        ]);
        $commandHandler = new ItemUpdateHandler($this->itemRepository);
        $commandHandler->handle($command);

        $item = $this->itemRepository->getOneByItemId($id);

        $this->assertEquals($name, $item->getName()->get());
        $this->assertEquals($propTime, $item->getPropTime()->get());
        $this->assertEquals($difficulty, $item->getDifficulty()->get());
        $this->assertEquals($vegetarian, $item->getVegetarian()->get());

    }

    public function providerForSuccess()
    {
        return [
            [
                'name'       => 'name',
                'propTime'   => '01:00',
                'difficulty' => '1',
                'vegetarian' => false,
            ],
            [
                'name'       => 'name',
                'propTime'   => '23:50',
                'difficulty' => '3',
                'vegetarian' => true,
            ],
            [
                'name'       => 'name',
                'propTime'   => '23:00',
                'difficulty' => '2',
                'vegetarian' => true,
            ]
        ];
    }

}