<?php


use PHPUnit\Framework\TestCase;
use Item\Application\CQRS\Command\Commands\ItemCreateCommand;
use Item\Application\CQRS\Command\Handler\ItemCreateHandler;
use Item\Infrastructure\Persistence\InMemory\ItemInMemoryRepository;

class ItemCreateHandlerTest extends TestCase
{
    /**
     * @var ItemInMemoryRepository
     */
    private $itemRepository;

    protected function setUp()
    {
        $this->itemRepository = new ItemInMemoryRepository();
    }

    /**
     * @dataProvider providerForFailed
     */
    public function testAddShouldFailed($name, $propTime, $difficulty, $vegetarian)
    {
        $this->expectException(InvalidArgumentException::class);
        $id = $this->itemRepository->nextIdentity();
        $command = new ItemCreateCommand($id, [
            'name'       => $name,
            'propTime'   => $propTime,
            'difficulty' => $difficulty,
            'vegetarian' => $vegetarian
        ]);
        $commandHandler = new ItemCreateHandler($this->itemRepository);
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
    public function testAddShouldSuccess($name, $propTime, $difficulty, $vegetarian)
    {
        $id = $this->itemRepository->nextIdentity();
        $command = new ItemCreateCommand($id, [
            'name'       => $name,
            'propTime'   => $propTime,
            'difficulty' => $difficulty,
            'vegetarian' => $vegetarian
        ]);
        $commandHandler = new ItemCreateHandler($this->itemRepository);
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
                'vegetarian' => true,
            ],
            [
                'name'       => 'name',
                'propTime'   => '23:50',
                'difficulty' => '1',
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