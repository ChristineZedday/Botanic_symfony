<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220715163801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE super_classe (id INT AUTO_INCREMENT NOT NULL, sous_embranchement_id INT DEFAULT NULL, embranchement_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, vernaculaire VARCHAR(255) DEFAULT NULL, INDEX IDX_42643B2FFF720C1E (sous_embranchement_id), INDEX IDX_42643B2FBBBA5020 (embranchement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE super_classe ADD CONSTRAINT FK_42643B2FFF720C1E FOREIGN KEY (sous_embranchement_id) REFERENCES sous_embranchement (id)');
        $this->addSql('ALTER TABLE super_classe ADD CONSTRAINT FK_42643B2FBBBA5020 FOREIGN KEY (embranchement_id) REFERENCES embranchement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE super_classe');
    }
}
