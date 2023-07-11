<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230711133840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__item AS SELECT id, category_id, name, price, vinted_link, olx_link, allegro_link, reserved, sold, image FROM item');
        $this->addSql('DROP TABLE item');
        $this->addSql('CREATE TABLE item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, customer_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, vinted_link VARCHAR(255) DEFAULT NULL, olx_link VARCHAR(255) DEFAULT NULL, allegro_link VARCHAR(255) DEFAULT NULL, reserved BOOLEAN NOT NULL, sold BOOLEAN NOT NULL, image VARCHAR(255) NOT NULL, CONSTRAINT FK_1F1B251E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1F1B251E9395C3F3 FOREIGN KEY (customer_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO item (id, category_id, name, price, vinted_link, olx_link, allegro_link, reserved, sold, image) SELECT id, category_id, name, price, vinted_link, olx_link, allegro_link, reserved, sold, image FROM __temp__item');
        $this->addSql('DROP TABLE __temp__item');
        $this->addSql('CREATE INDEX IDX_1F1B251E12469DE2 ON item (category_id)');
        $this->addSql('CREATE INDEX IDX_1F1B251E9395C3F3 ON item (customer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__item AS SELECT id, category_id, customer_id, name, price, vinted_link, olx_link, allegro_link, reserved, sold, image FROM item');
        $this->addSql('DROP TABLE item');
        $this->addSql('CREATE TABLE item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, reserved_by_id INTEGER DEFAULT NULL, bought_by_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, vinted_link VARCHAR(255) DEFAULT NULL, olx_link VARCHAR(255) DEFAULT NULL, allegro_link VARCHAR(255) DEFAULT NULL, reserved BOOLEAN NOT NULL, sold BOOLEAN NOT NULL, image VARCHAR(255) NOT NULL, CONSTRAINT FK_1F1B251E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1F1B251EBCDB4AF4 FOREIGN KEY (reserved_by_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1F1B251EDEC6D6BA FOREIGN KEY (bought_by_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO item (id, category_id, reserved_by_id, name, price, vinted_link, olx_link, allegro_link, reserved, sold, image) SELECT id, category_id, customer_id, name, price, vinted_link, olx_link, allegro_link, reserved, sold, image FROM __temp__item');
        $this->addSql('DROP TABLE __temp__item');
        $this->addSql('CREATE INDEX IDX_1F1B251E12469DE2 ON item (category_id)');
        $this->addSql('CREATE INDEX IDX_1F1B251EDEC6D6BA ON item (bought_by_id)');
        $this->addSql('CREATE INDEX IDX_1F1B251EBCDB4AF4 ON item (reserved_by_id)');
    }
}
