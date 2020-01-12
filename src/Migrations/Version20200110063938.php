<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200110063938 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commune (id INT AUTO_INCREMENT NOT NULL, commune VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abus (id INT AUTO_INCREMENT NOT NULL, internaute_id INT DEFAULT NULL, commentaire_id INT DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, encodage DATETIME DEFAULT NULL, INDEX IDX_72C9FD01CAF41882 (internaute_id), INDEX IDX_72C9FD01BA9CD190 (commentaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_letter (id INT AUTO_INCREMENT NOT NULL, document_pdf VARCHAR(255) DEFAULT NULL, publication DATETIME DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE position (id INT AUTO_INCREMENT NOT NULL, ordre INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, code_postal_id INT DEFAULT NULL, localite_id INT DEFAULT NULL, commune_id INT DEFAULT NULL, adresse_numero VARCHAR(255) DEFAULT NULL, adresse_rue VARCHAR(255) DEFAULT NULL, banni TINYINT(1) DEFAULT NULL, e_mail VARCHAR(255) DEFAULT NULL, inscription_conf TINYINT(1) DEFAULT NULL, inscription DATETIME DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, nb_essais_infructueux INT DEFAULT NULL, roles JSON NOT NULL, register_token VARCHAR(255) DEFAULT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B323DA1404 (e_mail), INDEX IDX_1D1C63B3B2B59251 (code_postal_id), INDEX IDX_1D1C63B3924DD2B5 (localite_id), INDEX IDX_1D1C63B3131A4F72 (commune_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, internaute_id INT DEFAULT NULL, prestataire_id INT DEFAULT NULL, contenu VARCHAR(255) DEFAULT NULL, cote INT DEFAULT NULL, encodage INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, INDEX IDX_67F068BCCAF41882 (internaute_id), INDEX IDX_67F068BCBE3DB2B7 (prestataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, prestataire_id INT DEFAULT NULL, categorie_de_services_id INT DEFAULT NULL, affichage_de DATETIME DEFAULT NULL, affichage_jusque DATETIME DEFAULT NULL, debut DATETIME DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, document_pdf VARCHAR(255) DEFAULT NULL, fin DATETIME DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, INDEX IDX_C11D7DD1BE3DB2B7 (prestataire_id), INDEX IDX_C11D7DD14A81A587 (categorie_de_services_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_de_services (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, en_avant TINYINT(1) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, valide TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_D8410DCC3DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bloc (id INT AUTO_INCREMENT NOT NULL, position_id INT DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, INDEX IDX_C778955ADD842E46 (position_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localite (id INT AUTO_INCREMENT NOT NULL, localite VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE code_postal (id INT AUTO_INCREMENT NOT NULL, code_postal VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire (id INT NOT NULL, e_mail_contact VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, num_tel VARCHAR(255) DEFAULT NULL, num_tva VARCHAR(255) DEFAULT NULL, site_internet VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire_categorie_de_services (prestataire_id INT NOT NULL, categorie_de_services_id INT NOT NULL, INDEX IDX_603DD9ABBE3DB2B7 (prestataire_id), INDEX IDX_603DD9AB4A81A587 (categorie_de_services_id), PRIMARY KEY(prestataire_id, categorie_de_services_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire_internaute (prestataire_id INT NOT NULL, internaute_id INT NOT NULL, INDEX IDX_BA91FCF0BE3DB2B7 (prestataire_id), INDEX IDX_BA91FCF0CAF41882 (internaute_id), PRIMARY KEY(prestataire_id, internaute_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internaute (id INT NOT NULL, image_id INT DEFAULT NULL, position_id INT DEFAULT NULL, news_letter TINYINT(1) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_6C8E97CC3DA5256D (image_id), INDEX IDX_6C8E97CCDD842E46 (position_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stage (id INT AUTO_INCREMENT NOT NULL, prestataire_id INT DEFAULT NULL, affichage_de DATETIME DEFAULT NULL, affichage_jusque DATETIME DEFAULT NULL, debut DATETIME DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, fin DATETIME DEFAULT NULL, info_complementaire VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, tarif VARCHAR(255) DEFAULT NULL, INDEX IDX_C27C9369BE3DB2B7 (prestataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, prestataire_id INT DEFAULT NULL, prestataire_photos_id INT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, ordre INT DEFAULT NULL, INDEX IDX_E01FBE6ABE3DB2B7 (prestataire_id), INDEX IDX_E01FBE6ACAC938C2 (prestataire_photos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abus ADD CONSTRAINT FK_72C9FD01CAF41882 FOREIGN KEY (internaute_id) REFERENCES internaute (id)');
        $this->addSql('ALTER TABLE abus ADD CONSTRAINT FK_72C9FD01BA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3B2B59251 FOREIGN KEY (code_postal_id) REFERENCES code_postal (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3924DD2B5 FOREIGN KEY (localite_id) REFERENCES localite (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCCAF41882 FOREIGN KEY (internaute_id) REFERENCES internaute (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCBE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD1BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD14A81A587 FOREIGN KEY (categorie_de_services_id) REFERENCES categorie_de_services (id)');
        $this->addSql('ALTER TABLE categorie_de_services ADD CONSTRAINT FK_D8410DCC3DA5256D FOREIGN KEY (image_id) REFERENCES images (id)');
        $this->addSql('ALTER TABLE bloc ADD CONSTRAINT FK_C778955ADD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestataire_categorie_de_services ADD CONSTRAINT FK_603DD9ABBE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestataire_categorie_de_services ADD CONSTRAINT FK_603DD9AB4A81A587 FOREIGN KEY (categorie_de_services_id) REFERENCES categorie_de_services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestataire_internaute ADD CONSTRAINT FK_BA91FCF0BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestataire_internaute ADD CONSTRAINT FK_BA91FCF0CAF41882 FOREIGN KEY (internaute_id) REFERENCES internaute (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internaute ADD CONSTRAINT FK_6C8E97CC3DA5256D FOREIGN KEY (image_id) REFERENCES images (id)');
        $this->addSql('ALTER TABLE internaute ADD CONSTRAINT FK_6C8E97CCDD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('ALTER TABLE internaute ADD CONSTRAINT FK_6C8E97CCBF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6ABE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6ACAC938C2 FOREIGN KEY (prestataire_photos_id) REFERENCES prestataire (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3131A4F72');
        $this->addSql('ALTER TABLE bloc DROP FOREIGN KEY FK_C778955ADD842E46');
        $this->addSql('ALTER TABLE internaute DROP FOREIGN KEY FK_6C8E97CCDD842E46');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480BF396750');
        $this->addSql('ALTER TABLE internaute DROP FOREIGN KEY FK_6C8E97CCBF396750');
        $this->addSql('ALTER TABLE abus DROP FOREIGN KEY FK_72C9FD01BA9CD190');
        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD14A81A587');
        $this->addSql('ALTER TABLE prestataire_categorie_de_services DROP FOREIGN KEY FK_603DD9AB4A81A587');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3924DD2B5');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3B2B59251');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCBE3DB2B7');
        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD1BE3DB2B7');
        $this->addSql('ALTER TABLE prestataire_categorie_de_services DROP FOREIGN KEY FK_603DD9ABBE3DB2B7');
        $this->addSql('ALTER TABLE prestataire_internaute DROP FOREIGN KEY FK_BA91FCF0BE3DB2B7');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369BE3DB2B7');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6ABE3DB2B7');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6ACAC938C2');
        $this->addSql('ALTER TABLE abus DROP FOREIGN KEY FK_72C9FD01CAF41882');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCCAF41882');
        $this->addSql('ALTER TABLE prestataire_internaute DROP FOREIGN KEY FK_BA91FCF0CAF41882');
        $this->addSql('ALTER TABLE categorie_de_services DROP FOREIGN KEY FK_D8410DCC3DA5256D');
        $this->addSql('ALTER TABLE internaute DROP FOREIGN KEY FK_6C8E97CC3DA5256D');
        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE abus');
        $this->addSql('DROP TABLE news_letter');
        $this->addSql('DROP TABLE position');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE categorie_de_services');
        $this->addSql('DROP TABLE bloc');
        $this->addSql('DROP TABLE localite');
        $this->addSql('DROP TABLE code_postal');
        $this->addSql('DROP TABLE prestataire');
        $this->addSql('DROP TABLE prestataire_categorie_de_services');
        $this->addSql('DROP TABLE prestataire_internaute');
        $this->addSql('DROP TABLE internaute');
        $this->addSql('DROP TABLE stage');
        $this->addSql('DROP TABLE images');
    }
}
