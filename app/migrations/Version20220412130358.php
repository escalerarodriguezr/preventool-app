<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20220412130358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create `user_table`';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, updater_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', email VARCHAR(100) NOT NULL, password VARCHAR(100) NOT NULL, role VARCHAR(50) NOT NULL, is_active TINYINT(1) NOT NULL, activation_code VARCHAR(200) NOT NULL, is_email_confirmed TINYINT(1) NOT NULL, created_on DATETIME NOT NULL, updated_on DATETIME NOT NULL, deleted_on DATETIME DEFAULT NULL, INDEX IDX_8D93D64961220EA6 (creator_id), INDEX IDX_8D93D649E37ECFB0 (updater_id), INDEX IDX_use_is_active (is_active), UNIQUE INDEX U_user_email (email), UNIQUE INDEX U_user_uuid (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_creator_id_user FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_updater_id_user FOREIGN KEY (updater_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_creator_id_user');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_updater_id_user');
        $this->addSql('DROP TABLE user');
    }
}
