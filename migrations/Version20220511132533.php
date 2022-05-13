<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511132533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE league (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE match_foot (id INT AUTO_INCREMENT NOT NULL, host_id INT NOT NULL, guest_id INT NOT NULL, league_id INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_A8E088E11FB8D185 (host_id), INDEX IDX_A8E088E19A4AA658 (guest_id), INDEX IDX_A8E088E158AFC4DE (league_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, league_id INT NOT NULL, nom VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_C4E0A61F58AFC4DE (league_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE match_foot ADD CONSTRAINT FK_A8E088E11FB8D185 FOREIGN KEY (host_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE match_foot ADD CONSTRAINT FK_A8E088E19A4AA658 FOREIGN KEY (guest_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE match_foot ADD CONSTRAINT FK_A8E088E158AFC4DE FOREIGN KEY (league_id) REFERENCES league (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F58AFC4DE FOREIGN KEY (league_id) REFERENCES league (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE match_foot DROP FOREIGN KEY FK_A8E088E158AFC4DE');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F58AFC4DE');
        $this->addSql('ALTER TABLE match_foot DROP FOREIGN KEY FK_A8E088E11FB8D185');
        $this->addSql('ALTER TABLE match_foot DROP FOREIGN KEY FK_A8E088E19A4AA658');
        $this->addSql('DROP TABLE league');
        $this->addSql('DROP TABLE match_foot');
        $this->addSql('DROP TABLE team');
    }
}
