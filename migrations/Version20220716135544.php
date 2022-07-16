<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220716135544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe ADD embranchement_id INT DEFAULT NULL, DROP embranchement');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96BBBA5020 FOREIGN KEY (embranchement_id) REFERENCES embranchement (id)');
        $this->addSql('CREATE INDEX IDX_8F87BF96BBBA5020 ON classe (embranchement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96BBBA5020');
        $this->addSql('DROP INDEX IDX_8F87BF96BBBA5020 ON classe');
        $this->addSql('ALTER TABLE classe ADD embranchement VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP embranchement_id');
    }
}
