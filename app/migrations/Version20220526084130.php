<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20220526084130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Crate `organization` table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE organization (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, updater_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', email VARCHAR(100) NOT NULL, name VARCHAR(200) NOT NULL, legal_document VARCHAR(100) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) NOT NULL, created_on DATETIME NOT NULL, updated_on DATETIME NOT NULL, INDEX IDX_C1EE637C61220EA6 (creator_id), INDEX IDX_C1EE637CE37ECFB0 (updater_id), INDEX IDX_organization_is_active (is_active), UNIQUE INDEX U_organization_email (email), UNIQUE INDEX U_organization_uuid (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE organization ADD CONSTRAINT FK_creator_id_organization FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE organization ADD CONSTRAINT FK_updater_id_organization FOREIGN KEY (updater_id) REFERENCES user (id)');
    }
    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE organization DROP FOREIGN KEY FK_creator_id_organization');
        $this->addSql('ALTER TABLE organization DROP FOREIGN KEY FK_updater_id_organization');
        $this->addSql('DROP TABLE organization');
    }
}
