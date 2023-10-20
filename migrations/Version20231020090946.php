<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231020090946 extends AbstractMigration
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
        $this->addSql('ALTER TABLE material CHANGE descripcion descripcion VARCHAR(255) DEFAULT NULL, CHANGE fecha_hora_ultimo_prestamo fecha_hora_ultimo_prestamo DATE DEFAULT NULL, CHANGE fecha_hora_ultima_devolucion fecha_hora_ultima_devolucion DATE DEFAULT NULL, CHANGE fecha_alta fecha_alta DATE DEFAULT NULL, CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historial CHANGE notas notas VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE localizacion CHANGE descripcion descripcion VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE material CHANGE descripcion descripcion VARCHAR(255) DEFAULT \'NULL\', CHANGE fecha_hora_ultimo_prestamo fecha_hora_ultimo_prestamo DATE DEFAULT \'NULL\', CHANGE fecha_hora_ultima_devolucion fecha_hora_ultima_devolucion DATE DEFAULT \'NULL\', CHANGE fecha_alta fecha_alta DATE DEFAULT \'NULL\', CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
    }
}
