<?php


use PHPUnit\Framework\TestCase;
use Item\Application\CQRS\Command\Commands\ItemCreateCommand;
use Item\Application\CQRS\Command\Commands\ItemRateCommand;
use Item\Application\CQRS\Command\Handler\ItemCreateHandler;
use Item\Application\CQRS\Command\Handler\ItemRateHandler;
use Item\Infrastructure\Persistence\InMemory\ItemInMemoryRepository;

class ItemRateHandlerTest extends TestCase
{
    /**
     * @var ItemInMemoryRepository
     */
    private $itemRepository;

    protected function setUp()
    {
        $this->itemRepository = new ItemInMemoryRepository();
    }

    public function testRateShouldFailedBecauseNotExistId()
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

        $command = new ItemRateCommand($id2, ['rating' => 3]);
        $commandHandler = new ItemRateHandler($this->itemRepository);
        $commandHandler->handle($command);
    }

    /**
     * @dataProvider providerForFailed
     */
    public function testRateShouldFailedBecauseWrongData($rate)
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


        $command = new ItemRateCommand($id, ['rating' => $rate]);
        $commandHandler = new ItemRateHandler($this->itemRepository);
        $commandHandler->handle($command);
    }


    public function providerForFailed()
    {
        return [
            [0], [6], [7], [8]
        ];

    }

    /**
     * @dataProvider providerForSuccess
     */
    public function testRateShouldSuccess()
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

        $rate = 4;


        $command = new ItemRateCommand($id, ['rating' => $rate]);
        $commandHandler = new ItemRateHandler($this->itemRepository);
        $commandHandler->handle($command);

        $item = $this->itemRepository->getOneByItemId($id);

        $values = [];
        foreach ($item->getRatings() as $rating) {
            $values[] = $rating->get();
        }
        $this->assertContains($rate, $values);

    }

    public function providerForSuccess()
    {
        return [
            [1], [2], [3], [4], [5]
        ];

    }


}