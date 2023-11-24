<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="persona")
 */
class Persona
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $nombreUsuario;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $clave;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $nombre;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $apellidos;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $administrador;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $gestorPrestamos;

    /**
     * @ORM\OneToMany(targetEntity="Material", mappedBy="persona")
     * @var Material[]|null
     */
    private $materiales;

    /**
     * @ORM\OneToMany(targetEntity="Material", mappedBy="responsable")
     * @var Material[]|null
     */
    private $materialesResponsable;

    /**
     * @ORM\OneToMany(targetEntity="Material", mappedBy="prestadoPor")
     * @var Material[]
     */
    private $materialesPrestados;

    public function __construct()
    {
        $this->materiales = new ArrayCollection();
        $this->materialesResponsable = new ArrayCollection();
        $this->materialesPrestados = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNombreUsuario(): string
    {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario(string $nombreUsuario): Persona
    {
        $this->nombreUsuario = $nombreUsuario;
        return $this;
    }

    public function getClave(): string
    {
        return $this->clave;
    }
    public function setClave(string $clave): Persona
    {
        $this->clave = $clave;
        return $this;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function setNombre(string $nombre): Persona
    {
        $this->nombre = $nombre;
        return $this;
    }
    public function getApellidos(): string
    {
        return $this->apellidos;
    }
    public function setApellidos(string $apellidos): Persona
    {
        $this->apellidos = $apellidos;
        return $this;
    }
    public function isAdministrador(): bool
    {
        return $this->administrador;
    }
    public function setAdministrador(bool $administrador): Persona
    {
        $this->administrador = $administrador;
        return $this;
    }
    public function isGestorPrestamos(): bool
    {
        return $this->gestorPrestamos;
    }
    public function setGestorPrestamos(bool $gestorPrestamos): Persona
    {
        $this->gestorPrestamos = $gestorPrestamos;
        return $this;
    }

    /**
     * @return Material[]|ArrayCollection|null
     */
    public function getMateriales()
    {
        return $this->materiales;
    }

    /**
     * @param Material[]|ArrayCollection|null $materiales
     * @return Persona
     */
    public function setMateriales($materiales)
    {
        $this->materiales = $materiales;
        return $this;
    }

    /**
     * @return Material[]|ArrayCollection|null
     */
    public function getMaterialesResponsable()
    {
        return $this->materialesResponsable;
    }

    /**
     * @param Material[]|ArrayCollection|null $materialesResponsable
     * @return Persona
     */
    public function setMaterialesResponsable($materialesResponsable)
    {
        $this->materialesResponsable = $materialesResponsable;
        return $this;
    }

    /**
     * @return Material[]|ArrayCollection
     */
    public function getMaterialesPrestados()
    {
        return $this->materialesPrestados;
    }

    /**
     * @param Material[]|ArrayCollection $materialesPrestados
     * @return Persona
     */
    public function setMaterialesPrestados($materialesPrestados)
    {
        $this->materialesPrestados = $materialesPrestados;
        return $this;
    }
}