<?php

namespace Item\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityRepository;

use Item\Domain\Model\Item\Item;
use Item\Domain\Model\Item\ValueObject\ItemId;
use Item\Domain\Model\Item\ItemRepositoryInterface;
use Item\Infrastructure\Persistence\Doctrine\Item as ItemDoctrine;
use Ramsey\Uuid\Uuid;
use Item\Domain\Model\Item\ValueObject;

class ItemRepository extends EntityRepository implements ItemRepositoryInterface
{


    /**
     * @param array $query
     * @return array of Item objects
     */
    public function getAll(array $params = []): array
    {
        if ($params) {

            $query = $this->createQueryBuilder('c')->where("1=1");
            if (isset($params['name']) && $params['name']) {
                $query->andWhere("c.name like '%$params[name]%'");
            }
            if (isset($params['propTime']) && $params['propTime']) {
                $query->andWhere("c.propTime = '$params[propTime]'");
            }
            if (isset($params['difficulty']) && $params['difficulty']) {
                $query->andWhere("c.difficulty = '$params[difficulty]'");
            }
            if (isset($params['vegetarian']) && $params['vegetarian']) {
               $params['vegetarian'] = $params['vegetarian']->get() ? 'true' : 'false';
                $query->andWhere("c.vegetarian = $params[vegetarian]");
            }
            $data = $query->getQuery()->getResult();
        } else {
            $data = $this->findAll();
        }

        // convert data to model data
        $return = [];
        foreach ($data as $row) {
            $return[] = $this->mapEntityToItemDomain($row);
        }
        return $return;
    }

    /**
     * @param ItemId $itemId
     * @return Item
     */
    public function getOneByItemId(ItemId $itemId): ?Item
    {
        $row = $this->find($itemId->toString());
        if ($row) {
            return $this->mapEntityToItemDomain($row);
        }
        return null;
    }

    /**
     * @param Item $item
     * @return mixed
     */
    public function create(Item $item): void
    {
        $row = new ItemDoctrine();
        $row->setName($item->getName()->get());
        $row->setVegetarian($item->getVegetarian()->get());
        $row->setPropTime(new \DateTime($item->getPropTime()->get()));
        $row->setDifficulty($item->getDifficulty()->get());
        $row->setItemId($item->getItemId()->toString());

        $this->getEntityManager()->persist($row);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Item $item
     */
    public function update(Item $item): void
    {
        $row = $this->find($item->getItemId()->toString());

        $row->setName($item->getName());
        $row->setVegetarian($item->getVegetarian());
        $row->setPropTime(new \DateTime($item->getPropTime()));
        $row->setDifficulty($item->getDifficulty());
        $this->getEntityManager()->persist($row);
        $this->getEntityManager()->flush();
    }

    public function rate(Item $item, ValueObject\Rating $rate): void
    {
        $row = $this->find($item->getItemId()->toString());
        $rating = new Rating();
        $rating->setValue($rate->get());
        $rating->setItem($row);
        $row->addRating($rating);
        $this->getEntityManager()->persist($row);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Item $item
     */
    public function remove(Item $item): void
    {
        $row = $this->find($item->getItemId()->toString());
        $this->getEntityManager()->remove($row);
        $this->getEntityManager()->flush();
    }

    /**
     * @return ItemId
     */
    public function nextIdentity(): ItemId
    {
        return ItemId::fromString((string)Uuid::uuid4());
    }

    private function mapEntityToItemDomain(ItemDoctrine $row): Item
    {

        $ratingsArray = [];
        foreach ($row->getRatings() as $rate) {
            /* @var \Item\Infrastructure\Persistence\Doctrine\Rating $rate */
            $ratingsArray[] = new ValueObject\Rating($rate->getValue());
        }

        /* @var ItemDoctrine $row */
        return new Item(
            ItemId::fromString($row->getItemId()),
            new ValueObject\Name($row->getName()),
            new ValueObject\PropTime($row->getPropTime()->format('H:i')),
            new ValueObject\Difficulty($row->getDifficulty()),
            new ValueObject\Vegetarian($row->getVegetarian()),
            $ratingsArray
        );
    }
}