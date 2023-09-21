<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230920094509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, gender VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, nationality VARCHAR(255) DEFAULT NULL, passport VARCHAR(255) DEFAULT NULL, passport_file VARCHAR(255) DEFAULT NULL, cv VARCHAR(255) DEFAULT NULL, profile_picture VARCHAR(255) DEFAULT NULL, current_location VARCHAR(255) DEFAULT NULL, birth_date DATE DEFAULT NULL, birth_place VARCHAR(255) DEFAULT NULL, availibility TINYINT(1) DEFAULT NULL, job_category VARCHAR(255) DEFAULT NULL, experience VARCHAR(255) DEFAULT NULL, short_description VARCHAR(255) DEFAULT NULL, notes VARCHAR(255) DEFAULT NULL, uploaded_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', files VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidature (id INT AUTO_INCREMENT NOT NULL, candidat_id INT NOT NULL, job_offer_id INT NOT NULL, INDEX IDX_E33BD3B88D0EB82 (candidat_id), INDEX IDX_E33BD3B83481D195 (job_offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, company_name VARCHAR(255) NOT NULL, activity_type VARCHAR(255) NOT NULL, contact_name VARCHAR(255) NOT NULL, position VARCHAR(255) NOT NULL, contact_number INT NOT NULL, contact_mail VARCHAR(255) NOT NULL, notes VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_offer (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, reference VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, notes VARCHAR(255) DEFAULT NULL, job_title VARCHAR(255) NOT NULL, job_type VARCHAR(255) NOT NULL, location VARCHAR(255) DEFAULT NULL, job_category VARCHAR(255) DEFAULT NULL, closing_date DATE NOT NULL, salary INT DEFAULT NULL, creation_date DATE NOT NULL, activated TINYINT(1) NOT NULL, INDEX IDX_288A3A4E19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B88D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B83481D195 FOREIGN KEY (job_offer_id) REFERENCES job_offer (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B88D0EB82');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B83481D195');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E19EB6921');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE candidature');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE job_offer');
        $this->addSql('DROP TABLE user');
    }
}
