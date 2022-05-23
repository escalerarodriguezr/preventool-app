<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20220523100434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create `company` table';


    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(200) NOT NULL, legal_document VARCHAR(100) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, created_on DATETIME NOT NULL, updated_on DATETIME NOT NULL, UNIQUE INDEX U_company_uuid (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE company');
    }
}
