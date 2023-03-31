<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331182035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE calendario (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(150) NOT NULL, asunto VARCHAR(255) NOT NULL, nombre_destinatario VARCHAR(150) NOT NULL, correo_destinatario VARCHAR(255) NOT NULL, fecha DATETIME NOT NULL, estado VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comentario (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, cargo VARCHAR(255) NOT NULL, fecha DATETIME NOT NULL, comentario VARCHAR(255) NOT NULL, INDEX IDX_4B91E702DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, calendarios_id INT DEFAULT NULL, nombre VARCHAR(50) NOT NULL, apellido VARCHAR(50) NOT NULL, email VARCHAR(250) NOT NULL, roles VARCHAR(25) NOT NULL, identificador VARCHAR(50) NOT NULL, cargo VARCHAR(25) NOT NULL, escuela VARCHAR(30) NOT NULL, area VARCHAR(50) NOT NULL, fecha_de_inicio DATE NOT NULL, fecha_de_finalizacion DATE DEFAULT NULL, responsable VARCHAR(50) NOT NULL, foto VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2265B05D83BDE30F (calendarios_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E702DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D83BDE30F FOREIGN KEY (calendarios_id) REFERENCES calendario (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E702DB38439E');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D83BDE30F');
        $this->addSql('DROP TABLE calendario');
        $this->addSql('DROP TABLE comentario');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
