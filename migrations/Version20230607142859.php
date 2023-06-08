<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230607142859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adoptant (id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adoption_offer (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, adoptants_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_accepted TINYINT(1) NOT NULL, INDEX IDX_65CB5B698805AB2F (annonce_id), INDEX IDX_65CB5B69239D7CD4 (adoptants_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adoption_offer_dog (adoption_offer_id INT NOT NULL, dog_id INT NOT NULL, INDEX IDX_FF56C20D74BEAA5D (adoption_offer_id), INDEX IDX_FF56C20D634DFEB (dog_id), PRIMARY KEY(adoption_offer_id, dog_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, annonceur_id INT NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', modified_at DATETIME NOT NULL, is_available TINYINT(1) NOT NULL, INDEX IDX_F65593E5C8764012 (annonceur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonceur (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dog (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, antecedant LONGTEXT DEFAULT NULL, is_adopted TINYINT(1) NOT NULL, accept_animmals TINYINT(1) NOT NULL, INDEX IDX_812C397D8805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, dog_id INT NOT NULL, path VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, INDEX IDX_C53D045F634DFEB (dog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, adoption_offer_id INT NOT NULL, subject VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, is_from_adoptant TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_B6BD307F74BEAA5D (adoption_offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, descritpion LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race_dog (race_id INT NOT NULL, dog_id INT NOT NULL, INDEX IDX_942774876E59D40D (race_id), INDEX IDX_94277487634DFEB (dog_id), PRIMARY KEY(race_id, dog_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adoptant ADD CONSTRAINT FK_7B42F2ABF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adoption_offer ADD CONSTRAINT FK_65CB5B698805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE adoption_offer ADD CONSTRAINT FK_65CB5B69239D7CD4 FOREIGN KEY (adoptants_id) REFERENCES adoptant (id)');
        $this->addSql('ALTER TABLE adoption_offer_dog ADD CONSTRAINT FK_FF56C20D74BEAA5D FOREIGN KEY (adoption_offer_id) REFERENCES adoption_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adoption_offer_dog ADD CONSTRAINT FK_FF56C20D634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5C8764012 FOREIGN KEY (annonceur_id) REFERENCES annonceur (id)');
        $this->addSql('ALTER TABLE annonceur ADD CONSTRAINT FK_E795BC5EBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dog ADD CONSTRAINT FK_812C397D8805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F74BEAA5D FOREIGN KEY (adoption_offer_id) REFERENCES adoption_offer (id)');
        $this->addSql('ALTER TABLE race_dog ADD CONSTRAINT FK_942774876E59D40D FOREIGN KEY (race_id) REFERENCES race (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE race_dog ADD CONSTRAINT FK_94277487634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD city VARCHAR(255) NOT NULL, ADD phone VARCHAR(16) NOT NULL, ADD zip_code VARCHAR(255) NOT NULL, ADD discr VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE adoptant DROP FOREIGN KEY FK_7B42F2ABF396750');
        $this->addSql('ALTER TABLE adoption_offer DROP FOREIGN KEY FK_65CB5B698805AB2F');
        $this->addSql('ALTER TABLE adoption_offer DROP FOREIGN KEY FK_65CB5B69239D7CD4');
        $this->addSql('ALTER TABLE adoption_offer_dog DROP FOREIGN KEY FK_FF56C20D74BEAA5D');
        $this->addSql('ALTER TABLE adoption_offer_dog DROP FOREIGN KEY FK_FF56C20D634DFEB');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5C8764012');
        $this->addSql('ALTER TABLE annonceur DROP FOREIGN KEY FK_E795BC5EBF396750');
        $this->addSql('ALTER TABLE dog DROP FOREIGN KEY FK_812C397D8805AB2F');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F634DFEB');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F74BEAA5D');
        $this->addSql('ALTER TABLE race_dog DROP FOREIGN KEY FK_942774876E59D40D');
        $this->addSql('ALTER TABLE race_dog DROP FOREIGN KEY FK_94277487634DFEB');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE adoptant');
        $this->addSql('DROP TABLE adoption_offer');
        $this->addSql('DROP TABLE adoption_offer_dog');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE annonceur');
        $this->addSql('DROP TABLE dog');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE race_dog');
        $this->addSql('ALTER TABLE user DROP city, DROP phone, DROP zip_code, DROP discr');
    }
}
