<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200323223808 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE information ADD gender VARCHAR(255) NOT NULL, ADD fever TINYINT(1) NOT NULL, ADD cough TINYINT(1) NOT NULL, ADD loss_of_taste TINYINT(1) NOT NULL, ADD sore_throat TINYINT(1) NOT NULL, ADD tired TINYINT(1) NOT NULL, ADD diarrhea TINYINT(1) NOT NULL, ADD problem_feeding TINYINT(1) NOT NULL, ADD pregnant TINYINT(1) NOT NULL, ADD treatment LONGTEXT NOT NULL, ADD date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE sickness CHANGE informations informations INT DEFAULT NULL');
        $this->addSql('ALTER TABLE volunteer CHANGE specialty_id specialty_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_user CHANGE salt salt VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE information DROP gender, DROP fever, DROP cough, DROP loss_of_taste, DROP sore_throat, DROP tired, DROP diarrhea, DROP problem_feeding, DROP pregnant, DROP treatment, DROP date');
        $this->addSql('ALTER TABLE sickness CHANGE informations informations INT DEFAULT NULL');
        $this->addSql('ALTER TABLE volunteer CHANGE specialty_id specialty_id INT DEFAULT NULL');
    }
}
