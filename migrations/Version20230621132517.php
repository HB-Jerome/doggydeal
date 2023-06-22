<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230621132517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adoption_offer DROP FOREIGN KEY FK_65CB5B69239D7CD4');
        $this->addSql('DROP INDEX IDX_65CB5B69239D7CD4 ON adoption_offer');
        $this->addSql('ALTER TABLE adoption_offer CHANGE adoptants_id adoptant_id INT NOT NULL');
        $this->addSql('ALTER TABLE adoption_offer ADD CONSTRAINT FK_65CB5B698D8B49F9 FOREIGN KEY (adoptant_id) REFERENCES adoptant (id)');
        $this->addSql('CREATE INDEX IDX_65CB5B698D8B49F9 ON adoption_offer (adoptant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adoption_offer DROP FOREIGN KEY FK_65CB5B698D8B49F9');
        $this->addSql('DROP INDEX IDX_65CB5B698D8B49F9 ON adoption_offer');
        $this->addSql('ALTER TABLE adoption_offer CHANGE adoptant_id adoptants_id INT NOT NULL');
        $this->addSql('ALTER TABLE adoption_offer ADD CONSTRAINT FK_65CB5B69239D7CD4 FOREIGN KEY (adoptants_id) REFERENCES adoptant (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_65CB5B69239D7CD4 ON adoption_offer (adoptants_id)');
    }
}
