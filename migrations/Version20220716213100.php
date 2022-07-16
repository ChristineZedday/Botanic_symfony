<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220716213100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ordre (id INT AUTO_INCREMENT NOT NULL, classe_id INT DEFAULT NULL, sous_classe_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, vernaculaire VARCHAR(255) DEFAULT NULL, INDEX IDX_737992C98F5EA509 (classe_id), INDEX IDX_737992C994574E46 (sous_classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ordre ADD CONSTRAINT FK_737992C98F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE ordre ADD CONSTRAINT FK_737992C994574E46 FOREIGN KEY (sous_classe_id) REFERENCES sous_classe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ordre');
    }
}
