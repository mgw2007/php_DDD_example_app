<?php


namespace Item\Infrastructure\Persistence;


use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class EntityManagerFactory
{
    /**
     * @return EntityManager
     */
    public static function createEntityManager($conn): EntityManager
    {
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"));
        $entityManager = EntityManager::create($conn, $config);
        return $entityManager;
    }
}
