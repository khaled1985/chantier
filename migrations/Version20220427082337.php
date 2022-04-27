<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220427082337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pointages ADD utilisateur_id INT DEFAULT NULL, ADD chantier_id INT DEFAULT NULL, DROP utilisateur, DROP chantier');
        $this->addSql('ALTER TABLE pointages ADD CONSTRAINT FK_2067B6D8FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE pointages ADD CONSTRAINT FK_2067B6D8D0C0049D FOREIGN KEY (chantier_id) REFERENCES chantiers (id)');
        $this->addSql('CREATE INDEX IDX_2067B6D8FB88E14F ON pointages (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_2067B6D8D0C0049D ON pointages (chantier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pointages DROP FOREIGN KEY FK_2067B6D8FB88E14F');
        $this->addSql('ALTER TABLE pointages DROP FOREIGN KEY FK_2067B6D8D0C0049D');
        $this->addSql('DROP INDEX IDX_2067B6D8FB88E14F ON pointages');
        $this->addSql('DROP INDEX IDX_2067B6D8D0C0049D ON pointages');
        $this->addSql('ALTER TABLE pointages ADD utilisateur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD chantier VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP utilisateur_id, DROP chantier_id');
    }
}
