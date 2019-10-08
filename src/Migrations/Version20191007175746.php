<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191007175746 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commune CHANGE commune commune VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE abus CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE news_letter CHANGE document_pdf document_pdf VARCHAR(255) DEFAULT NULL, CHANGE titre titre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE adresse_numero adresse_numero VARCHAR(255) DEFAULT NULL, CHANGE adresse_rue adresse_rue VARCHAR(255) DEFAULT NULL, CHANGE e_mail e_mail VARCHAR(255) DEFAULT NULL, CHANGE mot_de_passe mot_de_passe VARCHAR(255) DEFAULT NULL, CHANGE type_utilisateur type_utilisateur VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire CHANGE contenu contenu VARCHAR(255) DEFAULT NULL, CHANGE titre titre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE promotion CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE document_pdf document_pdf VARCHAR(255) DEFAULT NULL, CHANGE nom nom VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie_de_services CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE nom nom VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE bloc CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE nom nom VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE localite CHANGE localite localite VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE code_postal CHANGE code_postal code_postal VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE prestataire CHANGE e_mail_contact e_mail_contact VARCHAR(255) DEFAULT NULL, CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE num_tel num_tel VARCHAR(255) DEFAULT NULL, CHANGE num_tva num_tva VARCHAR(255) DEFAULT NULL, CHANGE site_internet site_internet VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE internaute CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE stage CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE info_complementaire info_complementaire VARCHAR(255) DEFAULT NULL, CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE tarif tarif VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE images CHANGE image image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE abus CHANGE description description VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE bloc CHANGE description description VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE nom nom VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE categorie_de_services CHANGE description description VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE nom nom VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE code_postal CHANGE code_postal code_postal VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE commentaire CHANGE contenu contenu VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE titre titre VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE commune CHANGE commune commune VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE images CHANGE image image VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE internaute CHANGE nom nom VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE prenom prenom VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE localite CHANGE localite localite VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE news_letter CHANGE document_pdf document_pdf VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE titre titre VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE prestataire CHANGE e_mail_contact e_mail_contact VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE nom nom VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE num_tel num_tel VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE num_tva num_tva VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE site_internet site_internet VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE promotion CHANGE description description VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE document_pdf document_pdf VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE nom nom VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE stage CHANGE description description VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE info_complementaire info_complementaire VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE nom nom VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE tarif tarif VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE utilisateur CHANGE adresse_numero adresse_numero VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE adresse_rue adresse_rue VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE e_mail e_mail VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE mot_de_passe mot_de_passe VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE type_utilisateur type_utilisateur VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
