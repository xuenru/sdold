<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180711220305 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0CA7BBEAD8');
        $this->addSql('DROP TABLE exame');
        $this->addSql('DROP INDEX IDX_D87F7E0CA7BBEAD8 ON test');
        $this->addSql('ALTER TABLE test ADD total_score INT NOT NULL, CHANGE exames_id candidate_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0C91BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('CREATE INDEX IDX_D87F7E0C91BD8781 ON test (candidate_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE exame (id INT AUTO_INCREMENT NOT NULL, candidat INT NOT NULL, score INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0C91BD8781');
        $this->addSql('DROP INDEX IDX_D87F7E0C91BD8781 ON test');
        $this->addSql('ALTER TABLE test DROP total_score, CHANGE candidate_id exames_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0CA7BBEAD8 FOREIGN KEY (exames_id) REFERENCES exame (id)');
        $this->addSql('CREATE INDEX IDX_D87F7E0CA7BBEAD8 ON test (exames_id)');
    }
}
