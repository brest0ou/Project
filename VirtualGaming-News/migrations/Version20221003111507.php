<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20221003111507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add table picture to User';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user ADD picture VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user DROP picture');
    }
}
