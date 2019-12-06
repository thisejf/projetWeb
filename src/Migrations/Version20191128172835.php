<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191128172835 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie_de_services ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie_de_services ADD CONSTRAINT FK_D8410DCC3DA5256D FOREIGN KEY (image_id) REFERENCES images (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D8410DCC3DA5256D ON categorie_de_services (image_id)');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A4A81A587');
        $this->addSql('DROP INDEX UNIQ_E01FBE6A4A81A587 ON images');
        $this->addSql('ALTER TABLE images DROP categorie_de_services_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie_de_services DROP FOREIGN KEY FK_D8410DCC3DA5256D');
        $this->addSql('DROP INDEX UNIQ_D8410DCC3DA5256D ON categorie_de_services');
        $this->addSql('ALTER TABLE categorie_de_services DROP image_id');
        $this->addSql('ALTER TABLE images ADD categorie_de_services_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A4A81A587 FOREIGN KEY (categorie_de_services_id) REFERENCES categorie_de_services (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E01FBE6A4A81A587 ON images (categorie_de_services_id)');
    }
}
