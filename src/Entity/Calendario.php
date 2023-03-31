<?php

namespace App\Entity;

use App\Repository\CalendarioRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalendarioRepository::class)]
class Calendario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $titulo = null;

    #[ORM\Column(length: 255)]
    private ?string $asunto = null;

    #[ORM\Column(length: 150)]
    private ?string $nombre_destinatario = null;

    #[ORM\Column(length: 255)]
    private ?string $correo_destinatario = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(length: 255)]
    private ?string $estado = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getAsunto(): ?string
    {
        return $this->asunto;
    }

    public function setAsunto(string $asunto): self
    {
        $this->asunto = $asunto;

        return $this;
    }

    public function getNombreDestinatario(): ?string
    {
        return $this->nombre_destinatario;
    }

    public function setNombreDestinatario(string $nombre_destinatario): self
    {
        $this->nombre_destinatario = $nombre_destinatario;

        return $this;
    }

    public function getCorreoDestinatario(): ?string
    {
        return $this->correo_destinatario;
    }

    public function setCorreoDestinatario(string $correo_destinatario): self
    {
        $this->correo_destinatario = $correo_destinatario;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }
}
