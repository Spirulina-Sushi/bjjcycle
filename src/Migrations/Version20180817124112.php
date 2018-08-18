<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180817124112 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE period (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, days INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cycle ADD period_id INT NOT NULL');
        $this->addSql('ALTER TABLE cycle ADD CONSTRAINT FK_B086D193EC8B7ADE FOREIGN KEY (period_id) REFERENCES period (id)');
        $this->addSql('CREATE INDEX IDX_B086D193EC8B7ADE ON cycle (period_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cycle DROP FOREIGN KEY FK_B086D193EC8B7ADE');
        $this->addSql('DROP TABLE period');
        $this->addSql('DROP INDEX IDX_B086D193EC8B7ADE ON cycle');
        $this->addSql('ALTER TABLE cycle DROP period_id');
    }
}
