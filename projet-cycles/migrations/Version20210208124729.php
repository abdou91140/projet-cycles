<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208124729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, create_at DATETIME NOT NULL, carrier_name VARCHAR(255) NOT NULL, carrier_price VARCHAR(255) NOT NULL, text VARCHAR(255) NOT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_details (id INT AUTO_INCREMENT NOT NULL, my_order_id INT NOT NULL, product VARCHAR(255) NOT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, total DOUBLE PRECISION NOT NULL, INDEX IDX_845CA2C1BFCDF877 (my_order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE order_details ADD CONSTRAINT FK_845CA2C1BFCDF877 FOREIGN KEY (my_order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE carrier CHANGE name name VARCHAR(255) NOT NULL, CHANGE description description TINYTEXT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_details DROP FOREIGN KEY FK_845CA2C1BFCDF877');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_details');
        $this->addSql('ALTER TABLE carrier CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
