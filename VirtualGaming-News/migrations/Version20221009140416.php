<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20221009140416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'change not null per nullable';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE game CHANGE users_id users_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE game CHANGE users_id users_id INT NOT NULL');
    }
}
