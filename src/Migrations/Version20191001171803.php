<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191001171803 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commune (id INT AUTO_INCREMENT NOT NULL, commune VARCHAR(10) DEFAULT NULL, identifiant INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abus (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(10) DEFAULT NULL, encodage DATETIME DEFAULT NULL, identifiant INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_letter (id INT AUTO_INCREMENT NOT NULL, document_pdf VARCHAR(10) DEFAULT NULL, identifiant INT DEFAULT NULL, publication DATETIME DEFAULT NULL, titre VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, adresse_numero VARCHAR(10) DEFAULT NULL, adresse_rue VARCHAR(10) DEFAULT NULL, banni TINYINT(1) DEFAULT NULL, e_mail VARCHAR(10) DEFAULT NULL, identifiant INT DEFAULT NULL, inscription_conf TINYINT(1) DEFAULT NULL, inscription DATETIME DEFAULT NULL, mot_de_passe VARCHAR(10) DEFAULT NULL, nb_essais_infructueux INT DEFAULT NULL, type_utilisateur VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, contenu VARCHAR(10) DEFAULT NULL, cote INT DEFAULT NULL, encodage INT DEFAULT NULL, identifiant INT DEFAULT NULL, titre VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, affichage_de DATETIME DEFAULT NULL, affichage_jusque DATETIME DEFAULT NULL, debut DATETIME DEFAULT NULL, description VARCHAR(10) DEFAULT NULL, document_pdf VARCHAR(10) DEFAULT NULL, fin DATETIME DEFAULT NULL, identifiant INT DEFAULT NULL, nom VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_de_services (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(10) DEFAULT NULL, en_avant TINYINT(1) DEFAULT NULL, identifiant INT DEFAULT NULL, nom VARCHAR(10) DEFAULT NULL, valide TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bloc (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(10) DEFAULT NULL, identifiant INT DEFAULT NULL, nom VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localite (id INT AUTO_INCREMENT NOT NULL, identifiant INT DEFAULT NULL, localite VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE code_postal (id INT AUTO_INCREMENT NOT NULL, code_postal VARCHAR(10) DEFAULT NULL, identifiant INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire (id INT AUTO_INCREMENT NOT NULL, e_mail_contact VARCHAR(10) DEFAULT NULL, identifiant INT DEFAULT NULL, nom VARCHAR(10) DEFAULT NULL, num_tel VARCHAR(10) DEFAULT NULL, num_tva VARCHAR(10) DEFAULT NULL, site_internet VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internaute (id INT AUTO_INCREMENT NOT NULL, identifiant INT DEFAULT NULL, news_letter TINYINT(1) DEFAULT NULL, nom VARCHAR(10) DEFAULT NULL, prenom VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stage (id INT AUTO_INCREMENT NOT NULL, affichage_de DATETIME DEFAULT NULL, affichage_jusque DATETIME DEFAULT NULL, debut DATETIME DEFAULT NULL, description VARCHAR(10) DEFAULT NULL, fin DATETIME DEFAULT NULL, indentifiant INT DEFAULT NULL, info_complementaire VARCHAR(10) DEFAULT NULL, nom VARCHAR(10) DEFAULT NULL, tarif VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, identifiant INT DEFAULT NULL, image VARCHAR(10) DEFAULT NULL, ordre INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE abus');
        $this->addSql('DROP TABLE news_letter');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE categorie_de_services');
        $this->addSql('DROP TABLE bloc');
        $this->addSql('DROP TABLE localite');
        $this->addSql('DROP TABLE code_postal');
        $this->addSql('DROP TABLE prestataire');
        $this->addSql('DROP TABLE internaute');
        $this->addSql('DROP TABLE stage');
        $this->addSql('DROP TABLE images');
    }
}
