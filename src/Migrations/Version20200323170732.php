<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200323170732 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE volunteer (id INT AUTO_INCREMENT NOT NULL, specialty_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, phone_number INT NOT NULL, picture VARCHAR(255) NOT NULL, INDEX IDX_5140DEDB9A353316 (specialty_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE volunteer ADD CONSTRAINT FK_5140DEDB9A353316 FOREIGN KEY (specialty_id) REFERENCES specialty (id)');
        $this->addSql('DROP TABLE voluntary');
        $this->addSql('ALTER TABLE sickness ADD informations INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sickness ADD CONSTRAINT FK_61AAF8CC6F966489 FOREIGN KEY (informations) REFERENCES information (id)');
        $this->addSql('CREATE INDEX IDX_61AAF8CC6F966489 ON sickness (informations)');
        $this->addSql('ALTER TABLE fos_user CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE voluntary (id INT AUTO_INCREMENT NOT NULL, specialty_id INT DEFAULT NULL, first_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, last_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, country VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phone_number INT NOT NULL, picture VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_C4182B199A353316 (specialty_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE voluntary ADD CONSTRAINT FK_C4182B199A353316 FOREIGN KEY (specialty_id) REFERENCES specialty (id)');
        $this->addSql('DROP TABLE volunteer');
        $this->addSql('ALTER TABLE fos_user CHANGE salt salt VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE sickness DROP FOREIGN KEY FK_61AAF8CC6F966489');
        $this->addSql('DROP INDEX IDX_61AAF8CC6F966489 ON sickness');
        $this->addSql('ALTER TABLE sickness DROP informations');
    }
}
