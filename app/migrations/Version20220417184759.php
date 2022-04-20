<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20220417184759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Alter `user_table` add name and lastName';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user ADD name VARCHAR(100) DEFAULT NULL, ADD last_name VARCHAR(200) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user DROP name, DROP last_name');
    }
}
