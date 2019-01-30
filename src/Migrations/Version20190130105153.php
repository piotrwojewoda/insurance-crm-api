<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190130105153 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, roles TINYTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', password_change_date INT DEFAULT NULL, enabled TINYINT(1) NOT NULL, confirmation_token VARCHAR(60) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE insurance_period_in_the_company (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, client_id INT NOT NULL, policy_id INT NOT NULL, value_id INT NOT NULL, startdate DATE NOT NULL, enddate DATE NOT NULL, INDEX IDX_ABB8E77B979B1AD6 (company_id), INDEX IDX_ABB8E77B19EB6921 (client_id), INDEX IDX_ABB8E77B2D29E3C6 (policy_id), INDEX IDX_ABB8E77BF920BBA2 (value_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE insurance_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, idnumber VARCHAR(255) NOT NULL, sex TINYINT(1) NOT NULL, email VARCHAR(255) DEFAULT NULL, birthdate DATE NOT NULL, foreigner TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE policy (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, code VARCHAR(255) NOT NULL, startdate DATE NOT NULL, enddate DATE NOT NULL, period VARCHAR(255) NOT NULL, published DATETIME NOT NULL, INDEX IDX_F07D0516F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, name VARCHAR(255) NOT NULL, long_name LONGTEXT NOT NULL, description LONGTEXT DEFAULT NULL, regon INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, lat_len LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', phone VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, INDEX IDX_4FBF094F8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE insurance_value (id INT AUTO_INCREMENT NOT NULL, insurance_type_id INT NOT NULL, insurance_category_id INT NOT NULL, value DOUBLE PRECISION NOT NULL, INDEX IDX_B2A36237286DA936 (insurance_type_id), INDEX IDX_B2A362374517BF8 (insurance_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE insurance_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE insurance_period_in_the_company ADD CONSTRAINT FK_ABB8E77B979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE insurance_period_in_the_company ADD CONSTRAINT FK_ABB8E77B19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE insurance_period_in_the_company ADD CONSTRAINT FK_ABB8E77B2D29E3C6 FOREIGN KEY (policy_id) REFERENCES policy (id)');
        $this->addSql('ALTER TABLE insurance_period_in_the_company ADD CONSTRAINT FK_ABB8E77BF920BBA2 FOREIGN KEY (value_id) REFERENCES insurance_value (id)');
        $this->addSql('ALTER TABLE policy ADD CONSTRAINT FK_F07D0516F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE insurance_value ADD CONSTRAINT FK_B2A36237286DA936 FOREIGN KEY (insurance_type_id) REFERENCES insurance_type (id)');
        $this->addSql('ALTER TABLE insurance_value ADD CONSTRAINT FK_B2A362374517BF8 FOREIGN KEY (insurance_category_id) REFERENCES insurance_category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE policy DROP FOREIGN KEY FK_F07D0516F675F31B');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F8BAC62AF');
        $this->addSql('ALTER TABLE insurance_value DROP FOREIGN KEY FK_B2A36237286DA936');
        $this->addSql('ALTER TABLE insurance_period_in_the_company DROP FOREIGN KEY FK_ABB8E77B19EB6921');
        $this->addSql('ALTER TABLE insurance_period_in_the_company DROP FOREIGN KEY FK_ABB8E77B2D29E3C6');
        $this->addSql('ALTER TABLE insurance_period_in_the_company DROP FOREIGN KEY FK_ABB8E77B979B1AD6');
        $this->addSql('ALTER TABLE insurance_period_in_the_company DROP FOREIGN KEY FK_ABB8E77BF920BBA2');
        $this->addSql('ALTER TABLE insurance_value DROP FOREIGN KEY FK_B2A362374517BF8');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE insurance_period_in_the_company');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE insurance_type');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE policy');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE insurance_value');
        $this->addSql('DROP TABLE insurance_category');
    }
}
