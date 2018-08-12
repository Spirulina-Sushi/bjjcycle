<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180812160710 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE arm_orientation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE leg_orientation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, top TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE position (id INT AUTO_INCREMENT NOT NULL, subsystem_id INT NOT NULL, arm_orientation_id INT NOT NULL, leg_orientation_id INT NOT NULL, INDEX IDX_462CE4F544FA849C (subsystem_id), INDEX IDX_462CE4F5B1EE49D1 (arm_orientation_id), INDEX IDX_462CE4F58135D920 (leg_orientation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_system (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technique (id INT AUTO_INCREMENT NOT NULL, start_position_id INT NOT NULL, end_position_id INT NOT NULL, player_id INT NOT NULL, type_id INT NOT NULL, game_id INT NOT NULL, name VARCHAR(60) NOT NULL, INDEX IDX_D73B984187F33EF2 (start_position_id), INDEX IDX_D73B9841D78AC839 (end_position_id), INDEX IDX_D73B984199E6F5DF (player_id), INDEX IDX_D73B9841C54C8C93 (type_id), INDEX IDX_D73B9841E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technique_video (technique_id INT NOT NULL, video_id INT NOT NULL, INDEX IDX_7C61DFBD1F8ACB26 (technique_id), INDEX IDX_7C61DFBD29C1004E (video_id), PRIMARY KEY(technique_id, video_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE position ADD CONSTRAINT FK_462CE4F544FA849C FOREIGN KEY (subsystem_id) REFERENCES sub_system (id)');
        $this->addSql('ALTER TABLE position ADD CONSTRAINT FK_462CE4F5B1EE49D1 FOREIGN KEY (arm_orientation_id) REFERENCES arm_orientation (id)');
        $this->addSql('ALTER TABLE position ADD CONSTRAINT FK_462CE4F58135D920 FOREIGN KEY (leg_orientation_id) REFERENCES leg_orientation (id)');
        $this->addSql('ALTER TABLE technique ADD CONSTRAINT FK_D73B984187F33EF2 FOREIGN KEY (start_position_id) REFERENCES position (id)');
        $this->addSql('ALTER TABLE technique ADD CONSTRAINT FK_D73B9841D78AC839 FOREIGN KEY (end_position_id) REFERENCES position (id)');
        $this->addSql('ALTER TABLE technique ADD CONSTRAINT FK_D73B984199E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE technique ADD CONSTRAINT FK_D73B9841C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE technique ADD CONSTRAINT FK_D73B9841E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE technique_video ADD CONSTRAINT FK_7C61DFBD1F8ACB26 FOREIGN KEY (technique_id) REFERENCES technique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE technique_video ADD CONSTRAINT FK_7C61DFBD29C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE position DROP FOREIGN KEY FK_462CE4F5B1EE49D1');
        $this->addSql('ALTER TABLE technique DROP FOREIGN KEY FK_D73B9841E48FD905');
        $this->addSql('ALTER TABLE position DROP FOREIGN KEY FK_462CE4F58135D920');
        $this->addSql('ALTER TABLE technique DROP FOREIGN KEY FK_D73B984199E6F5DF');
        $this->addSql('ALTER TABLE technique DROP FOREIGN KEY FK_D73B984187F33EF2');
        $this->addSql('ALTER TABLE technique DROP FOREIGN KEY FK_D73B9841D78AC839');
        $this->addSql('ALTER TABLE position DROP FOREIGN KEY FK_462CE4F544FA849C');
        $this->addSql('ALTER TABLE technique_video DROP FOREIGN KEY FK_7C61DFBD1F8ACB26');
        $this->addSql('ALTER TABLE technique DROP FOREIGN KEY FK_D73B9841C54C8C93');
        $this->addSql('ALTER TABLE technique_video DROP FOREIGN KEY FK_7C61DFBD29C1004E');
        $this->addSql('DROP TABLE arm_orientation');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE leg_orientation');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE position');
        $this->addSql('DROP TABLE sub_system');
        $this->addSql('DROP TABLE technique');
        $this->addSql('DROP TABLE technique_video');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE video');
    }
}
