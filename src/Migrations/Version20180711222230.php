<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180711222230 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE score CHANGE test_id test_id INT DEFAULT NULL, CHANGE question_id question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_329937511E5D0459 FOREIGN KEY (test_id) REFERENCES test (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_329937511E27F6BF FOREIGN KEY (question_id) REFERENCES test (id)');
        $this->addSql('CREATE INDEX IDX_329937511E5D0459 ON score (test_id)');
        $this->addSql('CREATE INDEX IDX_329937511E27F6BF ON score (question_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_329937511E5D0459');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_329937511E27F6BF');
        $this->addSql('DROP INDEX IDX_329937511E5D0459 ON score');
        $this->addSql('DROP INDEX IDX_329937511E27F6BF ON score');
        $this->addSql('ALTER TABLE score CHANGE test_id test_id INT NOT NULL, CHANGE question_id question_id INT NOT NULL');
    }
}
