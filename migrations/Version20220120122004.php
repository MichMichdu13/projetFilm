<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220120122004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fav_acteurs (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, id_acteur VARCHAR(255) NOT NULL, image_acteur VARCHAR(255) NOT NULL, name_acteur VARCHAR(255) NOT NULL, INDEX IDX_C748333E9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fav_film (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, id_film VARCHAR(255) NOT NULL, img_film VARCHAR(255) NOT NULL, titre_film VARCHAR(255) NOT NULL, INDEX IDX_9A5FE6FC9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fav_acteurs ADD CONSTRAINT FK_C748333E9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE fav_film ADD CONSTRAINT FK_9A5FE6FC9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE fav_acteurs');
        $this->addSql('DROP TABLE fav_film');
    }
}
