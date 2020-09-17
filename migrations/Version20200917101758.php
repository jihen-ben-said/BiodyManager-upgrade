<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200917101758 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD remover_user_id INT DEFAULT NULL, ADD creator_user_id INT NOT NULL, ADD modifier_user_id INT DEFAULT NULL, ADD type VARCHAR(255) DEFAULT NULL, ADD phone VARCHAR(20) DEFAULT NULL, ADD gender VARCHAR(255) NOT NULL, ADD first_name VARCHAR(100) DEFAULT NULL, ADD last_name VARCHAR(100) DEFAULT NULL, ADD birth_date DATE DEFAULT NULL, ADD picture VARCHAR(255) DEFAULT NULL, ADD address VARCHAR(255) DEFAULT NULL, ADD zip_code VARCHAR(10) DEFAULT NULL, ADD company_name VARCHAR(50) DEFAULT NULL, ADD job VARCHAR(255) DEFAULT NULL, ADD profession VARCHAR(255) DEFAULT NULL, ADD city_name VARCHAR(250) DEFAULT NULL, ADD device_serial_number VARCHAR(250) DEFAULT NULL, ADD serial_number VARCHAR(250) DEFAULT NULL, ADD enable_oauth TINYINT(1) DEFAULT NULL, ADD session_timeout INT DEFAULT NULL, ADD multiple_session TINYINT(1) DEFAULT NULL, ADD phone_validated TINYINT(1) DEFAULT NULL, ADD phone_validation_code VARCHAR(25) DEFAULT NULL, ADD authentification_mode VARCHAR(255) DEFAULT NULL, ADD enabled TINYINT(1) DEFAULT NULL, ADD confirmation_token VARCHAR(255) DEFAULT NULL, ADD password_requested_at DATETIME DEFAULT NULL, ADD locked TINYINT(1) DEFAULT NULL, ADD expired TINYINT(1) DEFAULT NULL, ADD expires_at DATETIME DEFAULT NULL, ADD credentials_expired TINYINT(1) DEFAULT NULL, ADD credentials_expired_at DATETIME DEFAULT NULL, ADD last_login DATETIME DEFAULT NULL, ADD last_failed_login DATETIME DEFAULT NULL, ADD login_count SMALLINT DEFAULT NULL, ADD failed_login_count SMALLINT DEFAULT NULL, ADD last_failed_login_count SMALLINT DEFAULT NULL, ADD is_dietetic TINYINT(1) DEFAULT NULL, ADD nutrilog_user VARCHAR(255) DEFAULT NULL, ADD created_at DATETIME NOT NULL, ADD removed TINYINT(1) NOT NULL, ADD removed_at DATETIME DEFAULT NULL, ADD height_unit VARCHAR(5) DEFAULT NULL, ADD weight_unit VARCHAR(5) DEFAULT NULL, ADD volum_unit VARCHAR(5) DEFAULT NULL, ADD tips_shown TINYINT(1) DEFAULT NULL, ADD modified_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492B669191 FOREIGN KEY (remover_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64929FC6AE1 FOREIGN KEY (creator_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64965787AC2 FOREIGN KEY (modifier_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6492B669191 ON user (remover_user_id)');
        $this->addSql('CREATE INDEX IDX_8D93D64929FC6AE1 ON user (creator_user_id)');
        $this->addSql('CREATE INDEX IDX_8D93D64965787AC2 ON user (modifier_user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6492B669191');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64929FC6AE1');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64965787AC2');
        $this->addSql('DROP INDEX IDX_8D93D6492B669191 ON user');
        $this->addSql('DROP INDEX IDX_8D93D64929FC6AE1 ON user');
        $this->addSql('DROP INDEX IDX_8D93D64965787AC2 ON user');
        $this->addSql('ALTER TABLE user DROP remover_user_id, DROP creator_user_id, DROP modifier_user_id, DROP type, DROP phone, DROP gender, DROP first_name, DROP last_name, DROP birth_date, DROP picture, DROP address, DROP zip_code, DROP company_name, DROP job, DROP profession, DROP city_name, DROP device_serial_number, DROP serial_number, DROP enable_oauth, DROP session_timeout, DROP multiple_session, DROP phone_validated, DROP phone_validation_code, DROP authentification_mode, DROP enabled, DROP confirmation_token, DROP password_requested_at, DROP locked, DROP expired, DROP expires_at, DROP credentials_expired, DROP credentials_expired_at, DROP last_login, DROP last_failed_login, DROP login_count, DROP failed_login_count, DROP last_failed_login_count, DROP is_dietetic, DROP nutrilog_user, DROP created_at, DROP removed, DROP removed_at, DROP height_unit, DROP weight_unit, DROP volum_unit, DROP tips_shown, DROP modified_at');
    }
}
