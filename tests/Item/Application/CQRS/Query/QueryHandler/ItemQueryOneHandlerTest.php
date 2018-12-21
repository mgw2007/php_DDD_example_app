<?php


use PHPUnit\Framework\TestCase;
use Item\Application\CQRS\Command\Commands\ItemQueryCommand;
use Item\Application\CQRS\Command\Handler\ItemQueryHandler;
use Item\Infrastructure\Persistence\InMemory\ItemInMemoryRepository;
use Item\Application\CQRS\Query\Queries\GetOneItemQuery;
use Item\Application\CQRS\Query\QueryHandler\ItemQueryOneHandler;
use Item\Application\CQRS\Command\Commands\ItemCreateCommand;
use Item\Application\CQRS\Command\Handler\ItemCreateHandler;

class ItemQueryOneHandlerTest extends TestCase
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
     * @dataProvider providerForSuccess
     */
    public function testQueryShouldSuccess($name, $propTime, $difficulty, $vegetarian)
    {
        //save good item
        $id = $this->itemRepository->nextIdentity();
        $command = new ItemCreateCommand($id, [
            'name'       => $name,
            'propTime'   => $propTime,
            'difficulty' => $difficulty,
            'vegetarian' => $vegetarian
        ]);
        $commandHandler = new ItemCreateHandler($this->itemRepository);
        $commandHandler->handle($command);


        $query = new GetOneItemQuery($id);
        $queryHandler = new ItemQueryOneHandler($this->itemRepository);
        $row = $queryHandler->query($query);
        $this->assertEquals($id, $row['id']);
        $this->assertEquals($name, $row['name']);
        $this->assertEquals($propTime, $row['propTime']);
        $this->assertEquals($difficulty, $row['difficulty']);
        $this->assertEquals($vegetarian, $row['vegetarian']);
    }

    public function providerForSuccess()
    {
        return [
            [
                'name'       => 'namegood',
                'propTime'   => '01:00',
                'difficulty' => '1',
                'vegetarian' => true,
                'query'      => json_encode(['name' => 'name'])
            ],
            [
                'name'       => 'name_good',
                'propTime'   => '23:50',
                'difficulty' => '1',
                'vegetarian' => true,
                'query'      => json_encode(['name' => 'name', 'propTime' => '23:50'])
            ],
            [
                'name'       => 'namez',
                'propTime'   => '23:00',
                'difficulty' => '2',
                'vegetarian' => true,
                'query'      => json_encode(['name' => 'name', 'vegetarian' => true])
            ]
        ];
    }

    /**
     * @dataProvider providerForFailed
     */
    public function testQueryShouldNotReturn($name, $propTime, $difficulty, $vegetarian)
    {
        $this->expectException(InvalidArgumentException::class);
        //save good item
        $id = $this->itemRepository->nextIdentity();
        $command = new ItemCreateCommand($id, [
            'name'       => $name,
            'propTime'   => $propTime,
            'difficulty' => $difficulty,
            'vegetarian' => $vegetarian
        ]);
        $commandHandler = new ItemCreateHandler($this->itemRepository);
        $commandHandler->handle($command);

        $id2 = $this->itemRepository->nextIdentity();

        $query = new GetOneItemQuery($id2);
        $queryHandler = new ItemQueryOneHandler($this->itemRepository);
        $data = $queryHandler->query($query);
    }

    public function providerForFailed()
    {
        return [
            [
                'name'       => 'namegood',
                'propTime'   => '01:00',
                'difficulty' => '1',
                'vegetarian' => true,
            ],

        ];
    }


}