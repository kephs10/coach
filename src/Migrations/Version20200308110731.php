<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200308110731 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD partenaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64998DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64998DE13AC ON user (partenaire_id)');
        $this->addSql('ALTER TABLE affectation DROP FOREIGN KEY FK_F4DD61D3F2C56620');
        $this->addSql('DROP INDEX IDX_F4DD61D3F2C56620 ON affectation');
        $this->addSql('ALTER TABLE affectation DROP compte_id');
        $this->addSql('ALTER TABLE transaction ADD compte_id INT DEFAULT NULL, DROP part_partenaire');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_723705D1F2C56620 ON transaction (compte_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE affectation ADD compte_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE affectation ADD CONSTRAINT FK_F4DD61D3F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_F4DD61D3F2C56620 ON affectation (compte_id)');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1F2C56620');
        $this->addSql('DROP INDEX IDX_723705D1F2C56620 ON transaction');
        $this->addSql('ALTER TABLE transaction ADD part_partenaire INT NOT NULL, DROP compte_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64998DE13AC');
        $this->addSql('DROP INDEX IDX_8D93D64998DE13AC ON user');
        $this->addSql('ALTER TABLE user DROP partenaire_id');
    }
}
