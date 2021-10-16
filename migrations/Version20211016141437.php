<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211016141437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise CHANGE siret siret VARCHAR(255) NOT NULL, CHANGE code_banque code_banque VARCHAR(255) NOT NULL, CHANGE code_guichet code_guichet VARCHAR(255) NOT NULL, CHANGE num_compte num_compte VARCHAR(255) NOT NULL, CHANGE cle_compte cle_compte VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise CHANGE siret siret INT NOT NULL, CHANGE code_banque code_banque INT NOT NULL, CHANGE code_guichet code_guichet INT NOT NULL, CHANGE num_compte num_compte INT NOT NULL, CHANGE cle_compte cle_compte INT NOT NULL');
    }
}
