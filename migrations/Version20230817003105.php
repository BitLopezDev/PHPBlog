<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230817003105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE new_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_797E6294F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post CHANGE avance avance LONGTEXT NOT NULL, CHANGE date date VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE users ADD roles JSON NOT NULL, DROP username, DROP phone, DROP totp, DROP recovery_mail, CHANGE email email VARCHAR(180) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE new_user');
        $this->addSql('ALTER TABLE post CHANGE avance avance TEXT DEFAULT NULL, CHANGE date date VARCHAR(50) DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_1483A5E9E7927C74 ON users');
        $this->addSql('ALTER TABLE users ADD username VARCHAR(255) NOT NULL, ADD phone VARCHAR(255) NOT NULL, ADD totp VARCHAR(255) DEFAULT NULL, ADD recovery_mail VARCHAR(255) DEFAULT NULL, DROP roles, CHANGE email email VARCHAR(255) NOT NULL, CHANGE password password LONGTEXT NOT NULL');
    }
}
