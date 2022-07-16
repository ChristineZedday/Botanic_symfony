<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220716115521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe ADD super_classe_id INT DEFAULT NULL, ADD sous_embranchement_id INT DEFAULT NULL, ADD vernaculaire VARCHAR(255) DEFAULT NULL, ADD embranchement VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96233D8ED6 FOREIGN KEY (super_classe_id) REFERENCES super_classe (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96FF720C1E FOREIGN KEY (sous_embranchement_id) REFERENCES sous_embranchement (id)');
        $this->addSql('CREATE INDEX IDX_8F87BF96233D8ED6 ON classe (super_classe_id)');
        $this->addSql('CREATE INDEX IDX_8F87BF96FF720C1E ON classe (sous_embranchement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96233D8ED6');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96FF720C1E');
        $this->addSql('DROP INDEX IDX_8F87BF96233D8ED6 ON classe');
        $this->addSql('DROP INDEX IDX_8F87BF96FF720C1E ON classe');
        $this->addSql('ALTER TABLE classe DROP super_classe_id, DROP sous_embranchement_id, DROP vernaculaire, DROP embranchement');
    }
}
