<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221016175043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fr_word ADD en_word_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fr_word ADD CONSTRAINT FK_6B16F87CB2D880ED FOREIGN KEY (en_word_id) REFERENCES en_word (id)');
        $this->addSql('CREATE INDEX IDX_6B16F87CB2D880ED ON fr_word (en_word_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fr_word DROP FOREIGN KEY FK_6B16F87CB2D880ED');
        $this->addSql('DROP INDEX IDX_6B16F87CB2D880ED ON fr_word');
        $this->addSql('ALTER TABLE fr_word DROP en_word_id');
    }
}
