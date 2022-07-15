<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220715151028 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_embranchement ADD embranchement_id INT NOT NULL');
        $this->addSql('ALTER TABLE sous_embranchement ADD CONSTRAINT FK_C722ECFFBBBA5020 FOREIGN KEY (embranchement_id) REFERENCES embranchement (id)');
        $this->addSql('CREATE INDEX IDX_C722ECFFBBBA5020 ON sous_embranchement (embranchement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_embranchement DROP FOREIGN KEY FK_C722ECFFBBBA5020');
        $this->addSql('DROP INDEX IDX_C722ECFFBBBA5020 ON sous_embranchement');
        $this->addSql('ALTER TABLE sous_embranchement DROP embranchement_id');
    }
}
