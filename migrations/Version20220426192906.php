<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220426192906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pointages (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, duree DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chantiers ADD pointages_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE chantiers ADD CONSTRAINT FK_4FB3F70584925C5D FOREIGN KEY (pointages_id) REFERENCES pointages (id)');
        $this->addSql('CREATE INDEX IDX_4FB3F70584925C5D ON chantiers (pointages_id)');
        $this->addSql('ALTER TABLE utilisateur ADD pointages_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B384925C5D FOREIGN KEY (pointages_id) REFERENCES pointages (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B384925C5D ON utilisateur (pointages_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chantiers DROP FOREIGN KEY FK_4FB3F70584925C5D');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B384925C5D');
        $this->addSql('DROP TABLE pointages');
        $this->addSql('DROP INDEX IDX_4FB3F70584925C5D ON chantiers');
        $this->addSql('ALTER TABLE chantiers DROP pointages_id');
        $this->addSql('DROP INDEX IDX_1D1C63B384925C5D ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP pointages_id');
    }
}
