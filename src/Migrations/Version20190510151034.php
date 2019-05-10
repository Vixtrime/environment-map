<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class     Version20190510151034 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sensor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, unit VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sessions_history (id INT AUTO_INCREMENT NOT NULL, session_id INT NOT NULL, sensor_id INT NOT NULL, sensor_data INT NOT NULL, coordinates LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', time DATETIME NOT NULL, INDEX IDX_BC9B80E9613FECDF (session_id), INDEX IDX_BC9B80E9A247991F (sensor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session_order (id INT AUTO_INCREMENT NOT NULL, session_id INT NOT NULL, coordinates LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', delivered TINYINT(1) NOT NULL, INDEX IDX_2E542B4E613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sessions_history ADD CONSTRAINT FK_BC9B80E9613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE sessions_history ADD CONSTRAINT FK_BC9B80E9A247991F FOREIGN KEY (sensor_id) REFERENCES sensor (id)');
        $this->addSql('ALTER TABLE session_order ADD CONSTRAINT FK_2E542B4E613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sessions_history DROP FOREIGN KEY FK_BC9B80E9A247991F');
        $this->addSql('ALTER TABLE sessions_history DROP FOREIGN KEY FK_BC9B80E9613FECDF');
        $this->addSql('ALTER TABLE session_order DROP FOREIGN KEY FK_2E542B4E613FECDF');
        $this->addSql('DROP TABLE sensor');
        $this->addSql('DROP TABLE sessions_history');
        $this->addSql('DROP TABLE session_order');
        $this->addSql('DROP TABLE session');
    }
}
