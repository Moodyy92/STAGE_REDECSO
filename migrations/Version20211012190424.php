<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211012190424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_devis (categorie_id INT NOT NULL, devis_id INT NOT NULL, INDEX IDX_7E5F28FBBCF5E72D (categorie_id), INDEX IDX_7E5F28FB41DEFADA (devis_id), PRIMARY KEY(categorie_id, devis_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devis_categorie (devis_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_38AE1C4E41DEFADA (devis_id), INDEX IDX_38AE1C4EBCF5E72D (categorie_id), PRIMARY KEY(devis_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devis_tache (devis_id INT NOT NULL, tache_id INT NOT NULL, INDEX IDX_85A43D5141DEFADA (devis_id), INDEX IDX_85A43D51D2235D39 (tache_id), PRIMARY KEY(devis_id, tache_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_devis ADD CONSTRAINT FK_7E5F28FBBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_devis ADD CONSTRAINT FK_7E5F28FB41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_categorie ADD CONSTRAINT FK_38AE1C4E41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_categorie ADD CONSTRAINT FK_38AE1C4EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_tache ADD CONSTRAINT FK_85A43D5141DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_tache ADD CONSTRAINT FK_85A43D51D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE categorie_devis');
        $this->addSql('DROP TABLE devis_categorie');
        $this->addSql('DROP TABLE devis_tache');
    }
}
