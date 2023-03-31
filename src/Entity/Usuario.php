<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 50)]
    private ?string $apellido = null;

    #[ORM\Column(length: 250)]
    private ?string $email = null;

    #[ORM\Column(length: 25)]
    private ?string $roles = null;

    #[ORM\Column(length: 50)]
    private ?string $identificador = null;

    #[ORM\Column(length: 25)]
    private ?string $cargo = null;

    #[ORM\Column(length: 30)]
    private ?string $escuela = null;

    #[ORM\Column(length: 50)]
    private ?string $area = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_de_inicio = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fecha_de_finalizacion = null;

    #[ORM\Column(length: 50)]
    private ?string $responsable = null;

    #[ORM\Column(length: 255)]
    private ?string $foto = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Calendario $calendarios = null;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Comentario::class)]
    private Collection $comentarios;


    public function __construct()
    {
        $this->comentarios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRoles(): ?string
    {
        return $this->roles;
    }

    public function setRoles(string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getIdentificador(): ?string
    {
        return $this->identificador;
    }

    public function setIdentificador(string $identificador): self
    {
        $this->identificador = $identificador;

        return $this;
    }

    public function getCargo(): ?string
    {
        return $this->cargo;
    }

    public function setCargo(string $cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getEscuela(): ?string
    {
        return $this->escuela;
    }

    public function setEscuela(string $escuela): self
    {
        $this->escuela = $escuela;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(string $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getFechaDeInicio(): ?\DateTimeInterface
    {
        return $this->fecha_de_inicio;
    }

    public function setFechaDeInicio(\DateTimeInterface $fecha_de_inicio): self
    {
        $this->fecha_de_inicio = $fecha_de_inicio;

        return $this;
    }

    public function getFechaDeFinalizacion(): ?\DateTimeInterface
    {
        return $this->fecha_de_finalizacion;
    }

    public function setFechaDeFinalizacion(?\DateTimeInterface $fecha_de_finalizacion): self
    {
        $this->fecha_de_finalizacion = $fecha_de_finalizacion;

        return $this;
    }

    public function getResponsable(): ?string
    {
        return $this->responsable;
    }

    public function setResponsable(string $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getCalendarios(): ?Calendario
    {
        return $this->calendarios;
    }

    public function setCalendarios(?Calendario $calendarios): self
    {
        $this->calendarios = $calendarios;

        return $this;
    }

  

    /**
     * @return Collection<int, Comentario>
     */
    public function getComentarios(): Collection
    {
        return $this->comentarios;
    }

    public function addComentario(Comentario $comentario): self
    {
        if (!$this->comentarios->contains($comentario)) {
            $this->comentarios->add($comentario);
            $comentario->setUsuario($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): self
    {
        if ($this->comentarios->removeElement($comentario)) {
            // set the owning side to null (unless already changed)
            if ($comentario->getUsuario() === $this) {
                $comentario->setUsuario(null);
            }
        }

        return $this;
    }

  
}
