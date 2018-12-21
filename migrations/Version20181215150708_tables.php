<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Types\Type;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181215150708_tables extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $tableItem = $schema->createTable('item');
        /* @var \Doctrine\DBAL\Schema\Table $tableItem */
        $tableItem->addColumn('itemId', Type::STRING);
        $tableItem->addColumn('name', Type::STRING);
        $tableItem->addColumn('propTime', Type::TIME);
        $tableItem->addColumn('difficulty', Type::INTEGER);
        $tableItem->addColumn('vegetarian', Type::BOOLEAN);
        $tableItem->setPrimaryKey(['itemId']);


        $tableRating = $schema->createTable('rating');
        $tableRating->addColumn('id', Type::INTEGER,['autoincrement' => true]);
        $tableRating->addColumn('value', Type::INTEGER);
        $tableRating->addColumn('itemId', Type::STRING);
        $tableRating->setPrimaryKey(['id']);
        $tableRating->addForeignKeyConstraint($tableItem, ['itemId'], ['itemId'], ["onUpdate" => "CASCADE", "onDelete" => "CASCADE"]);

        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $schema->dropTable('rating');
        $schema->dropTable('item');
    }
}
