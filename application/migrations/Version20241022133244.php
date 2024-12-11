<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<< HEAD:application/migrations/Version20241022133244.php
final class Version20241022133244 extends AbstractMigration
=======
final class Version20241019125453 extends AbstractMigration
>>>>>>> develop:application/migrations/Version20241019125453.php
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
<<<<<<< HEAD:application/migrations/Version20241022133244.php
        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
=======
        $this->addSql('ALTER TABLE movie ADD studio VARCHAR(255) NOT NULL, ADD genre VARCHAR(255) NOT NULL, ADD saga VARCHAR(255) NOT NULL');
>>>>>>> develop:application/migrations/Version20241019125453.php
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
<<<<<<< HEAD:application/migrations/Version20241022133244.php
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP username');
=======
        $this->addSql('ALTER TABLE movie DROP studio, DROP genre, DROP saga');
>>>>>>> develop:application/migrations/Version20241019125453.php
    }
}
