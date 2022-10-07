<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221007195319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'change value to nullable';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE game DROP follow, CHANGE update_at update_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE post CHANGE posts_id posts_id INT DEFAULT NULL, CHANGE games_posts_id games_posts_id INT DEFAULT NULL, CHANGE status status VARCHAR(255) DEFAULT NULL, CHANGE grades grades INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user CHANGE created_at created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE game ADD follow INT DEFAULT NULL, CHANGE update_at update_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE post CHANGE posts_id posts_id INT NOT NULL, CHANGE games_posts_id games_posts_id INT NOT NULL, CHANGE status status VARCHAR(50) NOT NULL, CHANGE grades grades INT NOT NULL, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
