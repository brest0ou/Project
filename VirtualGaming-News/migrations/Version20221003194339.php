<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221003194339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'test';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE game DROP follow');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE game ADD follow INT DEFAULT NULL');
    }
}
