<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230919144824 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, gender VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, nationality VARCHAR(255) DEFAULT NULL, passport VARCHAR(255) DEFAULT NULL, passport_file VARCHAR(255) DEFAULT NULL, cv VARCHAR(255) DEFAULT NULL, profile_picture VARCHAR(255) DEFAULT NULL, current_location VARCHAR(255) DEFAULT NULL, birth_date DATE DEFAULT NULL, birth_place VARCHAR(255) DEFAULT NULL, availibility TINYINT(1) DEFAULT NULL, job_category VARCHAR(255) DEFAULT NULL, experience VARCHAR(255) DEFAULT NULL, short_description VARCHAR(255) DEFAULT NULL, notes VARCHAR(255) DEFAULT NULL, uploaded_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', files VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE product');
        $this->addSql('ALTER TABLE user DROP name');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('ALTER TABLE user ADD name VARCHAR(255) NOT NULL');
    }
}
