<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241019124534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actor_movie (actor_id INT NOT NULL, movie_id INT NOT NULL, INDEX IDX_39DA19FB10DAF24A (actor_id), INDEX IDX_39DA19FB8F93B6FC (movie_id), PRIMARY KEY(actor_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie_category (movie_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_DABA824C8F93B6FC (movie_id), INDEX IDX_DABA824C12469DE2 (category_id), PRIMARY KEY(movie_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actor_movie ADD CONSTRAINT FK_39DA19FB10DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor_movie ADD CONSTRAINT FK_39DA19FB8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_category ADD CONSTRAINT FK_DABA824C8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_category ADD CONSTRAINT FK_DABA824C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_actor DROP FOREIGN KEY FK_AC4619B010DAF24A');
        $this->addSql('ALTER TABLE category_actor DROP FOREIGN KEY FK_AC4619B012469DE2');
        $this->addSql('ALTER TABLE movie_movie DROP FOREIGN KEY FK_631CE8F3A64DE206');
        $this->addSql('ALTER TABLE movie_movie DROP FOREIGN KEY FK_631CE8F3BFA8B289');
        $this->addSql('ALTER TABLE movie_actor DROP FOREIGN KEY FK_3A374C658F93B6FC');
        $this->addSql('ALTER TABLE movie_actor DROP FOREIGN KEY FK_3A374C6510DAF24A');
        $this->addSql('ALTER TABLE actor_actor DROP FOREIGN KEY FK_60F1BD6DA8CCACC5');
        $this->addSql('ALTER TABLE actor_actor DROP FOREIGN KEY FK_60F1BD6DB129FC4A');
        $this->addSql('DROP TABLE category_actor');
        $this->addSql('DROP TABLE movie_movie');
        $this->addSql('DROP TABLE movie_actor');
        $this->addSql('DROP TABLE actor_actor');
        $this->addSql('ALTER TABLE actor ADD death_date DATE DEFAULT NULL, DROP movie, DROP name, CHANGE lastname lastname VARCHAR(255) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE category CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE movie DROP studio, DROP genre, DROP saga');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_actor (category_id INT NOT NULL, actor_id INT NOT NULL, INDEX IDX_AC4619B010DAF24A (actor_id), INDEX IDX_AC4619B012469DE2 (category_id), PRIMARY KEY(category_id, actor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE movie_movie (movie_source INT NOT NULL, movie_target INT NOT NULL, INDEX IDX_631CE8F3BFA8B289 (movie_target), INDEX IDX_631CE8F3A64DE206 (movie_source), PRIMARY KEY(movie_source, movie_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE movie_actor (movie_id INT NOT NULL, actor_id INT NOT NULL, INDEX IDX_3A374C658F93B6FC (movie_id), INDEX IDX_3A374C6510DAF24A (actor_id), PRIMARY KEY(movie_id, actor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE actor_actor (actor_source INT NOT NULL, actor_target INT NOT NULL, INDEX IDX_60F1BD6DB129FC4A (actor_target), INDEX IDX_60F1BD6DA8CCACC5 (actor_source), PRIMARY KEY(actor_source, actor_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE category_actor ADD CONSTRAINT FK_AC4619B010DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_actor ADD CONSTRAINT FK_AC4619B012469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_movie ADD CONSTRAINT FK_631CE8F3A64DE206 FOREIGN KEY (movie_source) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_movie ADD CONSTRAINT FK_631CE8F3BFA8B289 FOREIGN KEY (movie_target) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_actor ADD CONSTRAINT FK_3A374C658F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_actor ADD CONSTRAINT FK_3A374C6510DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor_actor ADD CONSTRAINT FK_60F1BD6DA8CCACC5 FOREIGN KEY (actor_source) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor_actor ADD CONSTRAINT FK_60F1BD6DB129FC4A FOREIGN KEY (actor_target) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor_movie DROP FOREIGN KEY FK_39DA19FB10DAF24A');
        $this->addSql('ALTER TABLE actor_movie DROP FOREIGN KEY FK_39DA19FB8F93B6FC');
        $this->addSql('ALTER TABLE movie_category DROP FOREIGN KEY FK_DABA824C8F93B6FC');
        $this->addSql('ALTER TABLE movie_category DROP FOREIGN KEY FK_DABA824C12469DE2');
        $this->addSql('DROP TABLE actor_movie');
        $this->addSql('DROP TABLE movie_category');
        $this->addSql('ALTER TABLE actor ADD movie VARCHAR(255) NOT NULL, ADD name VARCHAR(255) NOT NULL, DROP death_date, CHANGE lastname lastname VARCHAR(255) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE movie ADD studio VARCHAR(255) NOT NULL, ADD genre VARCHAR(255) NOT NULL, ADD saga VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE category CHANGE updated_at updated_at DATETIME NOT NULL');
    }
}
