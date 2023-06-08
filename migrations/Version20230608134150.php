<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608134150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adoptant CHANGE first_name first_name VARCHAR(255) DEFAULT NULL, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE city city VARCHAR(255) DEFAULT NULL, CHANGE phone phone VARCHAR(16) DEFAULT NULL, CHANGE zip_code zip_code VARCHAR(255) DEFAULT NULL, CHANGE username username VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adoptant CHANGE first_name first_name VARCHAR(255) NOT NULL, CHANGE last_name last_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE city city VARCHAR(255) NOT NULL, CHANGE phone phone VARCHAR(16) NOT NULL, CHANGE zip_code zip_code VARCHAR(255) NOT NULL, CHANGE username username VARCHAR(255) NOT NULL');
    }
}
