<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191220080905 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, type VARCHAR(50) NOT NULL, site VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_offre_stage (formation_id INT NOT NULL, offre_stage_id INT NOT NULL, INDEX IDX_CAAB54295200282E (formation_id), INDEX IDX_CAAB5429195A2A28 (offre_stage_id), PRIMARY KEY(formation_id, offre_stage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formation_offre_stage ADD CONSTRAINT FK_CAAB54295200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_offre_stage ADD CONSTRAINT FK_CAAB5429195A2A28 FOREIGN KEY (offre_stage_id) REFERENCES offre_stage (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE entreprises');
        $this->addSql('ALTER TABLE offre_stage ADD entreprise_id INT NOT NULL');
        $this->addSql('ALTER TABLE offre_stage ADD CONSTRAINT FK_955674F2A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_955674F2A4AEAFEA ON offre_stage (entreprise_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offre_stage DROP FOREIGN KEY FK_955674F2A4AEAFEA');
        $this->addSql('CREATE TABLE entreprises (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, site VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE formation_offre_stage');
        $this->addSql('DROP INDEX IDX_955674F2A4AEAFEA ON offre_stage');
        $this->addSql('ALTER TABLE offre_stage DROP entreprise_id');
    }
}
