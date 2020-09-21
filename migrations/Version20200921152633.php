<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200921152633 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shopping_cart (id CHAR(36) NOT NULL --(DC2Type:guid)
        , PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE shopping_cart_products (product_id CHAR(36) NOT NULL --(DC2Type:guid)
        , shopping_cart_id INTEGER NOT NULL, PRIMARY KEY(product_id, shopping_cart_id))');
        $this->addSql('CREATE INDEX IDX_5FF0FD264584665A ON shopping_cart_products (product_id)');
        $this->addSql('CREATE INDEX IDX_5FF0FD2645F80CD ON shopping_cart_products (shopping_cart_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE shopping_cart');
        $this->addSql('DROP TABLE shopping_cart_products');
    }
}
