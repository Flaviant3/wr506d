<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240917075714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actor (id INT AUTO_INCREMENT NOT NULL, movie VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, dob DATE NOT NULL, awards INT DEFAULT NULL, bio LONGTEXT DEFAULT NULL, nationality VARCHAR(255) NOT NULL, media VARCHAR(255) DEFAULT NULL, gender VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actor_actor (actor_source INT NOT NULL, actor_target INT NOT NULL, INDEX IDX_60F1BD6DA8CCACC5 (actor_source), INDEX IDX_60F1BD6DB129FC4A (actor_target), PRIMARY KEY(actor_source, actor_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_actor (category_id INT NOT NULL, actor_id INT NOT NULL, INDEX IDX_AC4619B012469DE2 (category_id), INDEX IDX_AC4619B010DAF24A (actor_id), PRIMARY KEY(category_id, actor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, release_date DATE DEFAULT NULL, duration INT DEFAULT NULL, entries INT DEFAULT NULL, director VARCHAR(255) DEFAULT NULL, rating DOUBLE PRECISION DEFAULT NULL, media VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie_actor (movie_id INT NOT NULL, actor_id INT NOT NULL, INDEX IDX_3A374C658F93B6FC (movie_id), INDEX IDX_3A374C6510DAF24A (actor_id), PRIMARY KEY(movie_id, actor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie_movie (movie_source INT NOT NULL, movie_target INT NOT NULL, INDEX IDX_631CE8F3A64DE206 (movie_source), INDEX IDX_631CE8F3BFA8B289 (movie_target), PRIMARY KEY(movie_source, movie_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actor_actor ADD CONSTRAINT FK_60F1BD6DA8CCACC5 FOREIGN KEY (actor_source) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor_actor ADD CONSTRAINT FK_60F1BD6DB129FC4A FOREIGN KEY (actor_target) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_actor ADD CONSTRAINT FK_AC4619B012469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_actor ADD CONSTRAINT FK_AC4619B010DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_actor ADD CONSTRAINT FK_3A374C658F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_actor ADD CONSTRAINT FK_3A374C6510DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_movie ADD CONSTRAINT FK_631CE8F3A64DE206 FOREIGN KEY (movie_source) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_movie ADD CONSTRAINT FK_631CE8F3BFA8B289 FOREIGN KEY (movie_target) REFERENCES movie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor_actor DROP FOREIGN KEY FK_60F1BD6DA8CCACC5');
        $this->addSql('ALTER TABLE actor_actor DROP FOREIGN KEY FK_60F1BD6DB129FC4A');
        $this->addSql('ALTER TABLE category_actor DROP FOREIGN KEY FK_AC4619B012469DE2');
        $this->addSql('ALTER TABLE category_actor DROP FOREIGN KEY FK_AC4619B010DAF24A');
        $this->addSql('ALTER TABLE movie_actor DROP FOREIGN KEY FK_3A374C658F93B6FC');
        $this->addSql('ALTER TABLE movie_actor DROP FOREIGN KEY FK_3A374C6510DAF24A');
        $this->addSql('ALTER TABLE movie_movie DROP FOREIGN KEY FK_631CE8F3A64DE206');
        $this->addSql('ALTER TABLE movie_movie DROP FOREIGN KEY FK_631CE8F3BFA8B289');
        $this->addSql('DROP TABLE actor');
        $this->addSql('DROP TABLE actor_actor');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_actor');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE movie_actor');
        $this->addSql('DROP TABLE movie_movie');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
