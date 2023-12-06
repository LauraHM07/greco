<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="persona")
 */
class Persona implements UserInterface
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Historial", mappedBy="prestadoPor")
     * @var Historial|null
     */
    private $prestamosRealizados;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Historial", mappedBy="prestadoA")
     * @var Historial|null
     */
    private $prestamosRecibidos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Historial", mappedBy="devueltoPor")
     * @var Historial|null
     */
    private $devoluciones;

    public function __construct()
    {
        $this->materiales = new ArrayCollection();
        $this->materialesResponsable = new ArrayCollection();
        $this->materialesPrestados = new ArrayCollection();
        $this->prestamosRealizados = new ArrayCollection();
        $this->prestamosRecibidos = new ArrayCollection();
        $this->devoluciones = new ArrayCollection();
    }

    public function getId(): ?int
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

    public function getPrestamosRealizados(): ?Historial
    {
        return $this->prestamosRealizados;
    }

    public function setPrestamosRealizados(?Historial $prestamosRealizados): Persona
    {
        $this->prestamosRealizados = $prestamosRealizados;
        return $this;
    }

    public function getPrestamosRecibidos(): ?Historial
    {
        return $this->prestamosRecibidos;
    }

    public function setPrestamosRecibidos(?Historial $prestamosRecibidos): Persona
    {
        $this->prestamosRecibidos = $prestamosRecibidos;
        return $this;
    }

    public function getDevoluciones(): ?Historial
    {
        return $this->devoluciones;
    }

    public function setDevoluciones(?Historial $devoluciones): Persona
    {
        $this->devoluciones = $devoluciones;
        return $this;
    }

    public function getRoles()
    {
        $roles = ['ROLE_USUARIO'];

        if ($this->isAdministrador()) {
            $roles[] = 'ROLE_ADMIN';
        }

        if ($this->isGestorPrestamos()) {
            $roles[] = 'ROLE_GESTOR';
        }

        return $roles;
    }

    public function getPassword()
    {
        return $this->clave;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->getNombreUsuario();
    }

    public function eraseCredentials()
    {
    }
}