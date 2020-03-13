<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200313022747 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users (id INT UNSIGNED AUTO_INCREMENT NOT NULL, email VARCHAR(128) NOT NULL, password VARCHAR(128) DEFAULT NULL, first_name VARCHAR(64) DEFAULT NULL, last_name VARCHAR(64) DEFAULT NULL, created DATETIME NOT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), INDEX user_active_lname (active, last_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_roles (user_id INT UNSIGNED NOT NULL, role_id INT NOT NULL, INDEX IDX_51498A8EA76ED395 (user_id), INDEX IDX_51498A8ED60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, role VARCHAR(16) NOT NULL, UNIQUE INDEX UNIQ_B63E2EC757698A6A (role), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_roles ADD CONSTRAINT FK_51498A8EA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users_roles ADD CONSTRAINT FK_51498A8ED60322AC FOREIGN KEY (role_id) REFERENCES roles (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users_roles DROP FOREIGN KEY FK_51498A8EA76ED395');
        $this->addSql('ALTER TABLE users_roles DROP FOREIGN KEY FK_51498A8ED60322AC');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE users_roles');
        $this->addSql('DROP TABLE roles');
    }
}
