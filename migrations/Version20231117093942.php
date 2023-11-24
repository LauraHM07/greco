<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231117093942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historial CHANGE notas notas VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE localizacion CHANGE descripcion descripcion VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE material ADD persona_id INT DEFAULT NULL, ADD responsable_id INT DEFAULT NULL, ADD prestado_por_id INT DEFAULT NULL, CHANGE descripcion descripcion VARCHAR(255) DEFAULT NULL, CHANGE fecha_hora_ultimo_prestamo fecha_hora_ultimo_prestamo DATE DEFAULT NULL, CHANGE fecha_hora_ultima_devolucion fecha_hora_ultima_devolucion DATE DEFAULT NULL, CHANGE fecha_alta fecha_alta DATE DEFAULT NULL, CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE7595F5F88DB9 FOREIGN KEY (persona_id) REFERENCES persona (id)');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE759553C59D72 FOREIGN KEY (responsable_id) REFERENCES persona (id)');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE75957FF7B85C FOREIGN KEY (prestado_por_id) REFERENCES persona (id)');
        $this->addSql('CREATE INDEX IDX_7CBE7595F5F88DB9 ON material (persona_id)');
        $this->addSql('CREATE INDEX IDX_7CBE759553C59D72 ON material (responsable_id)');
        $this->addSql('CREATE INDEX IDX_7CBE75957FF7B85C ON material (prestado_por_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historial CHANGE notas notas VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE localizacion CHANGE descripcion descripcion VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE7595F5F88DB9');
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE759553C59D72');
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE75957FF7B85C');
        $this->addSql('DROP INDEX IDX_7CBE7595F5F88DB9 ON material');
        $this->addSql('DROP INDEX IDX_7CBE759553C59D72 ON material');
        $this->addSql('DROP INDEX IDX_7CBE75957FF7B85C ON material');
        $this->addSql('ALTER TABLE material DROP persona_id, DROP responsable_id, DROP prestado_por_id, CHANGE descripcion descripcion VARCHAR(255) DEFAULT \'NULL\', CHANGE fecha_hora_ultimo_prestamo fecha_hora_ultimo_prestamo DATE DEFAULT \'NULL\', CHANGE fecha_hora_ultima_devolucion fecha_hora_ultima_devolucion DATE DEFAULT \'NULL\', CHANGE fecha_alta fecha_alta DATE DEFAULT \'NULL\', CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
    }
}
