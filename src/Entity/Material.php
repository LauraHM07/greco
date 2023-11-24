<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="material")
 */
class Material
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
    private $nombre;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    private $descripcion;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @var \DateTime|null
     */
    private $fechaHoraUltimoPrestamo;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @var \DateTime|null
     */
    private $fechaHoraUltimaDevolucion;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $disponible;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @var \DateTime|null
     */
    private $fechaAlta;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @var \DateTime|null
     */
    private $fechaBaja;

    /**
     * @ORM\ManyToOne(targetEntity="Localizacion", inversedBy="materiales")
     * @var Localizacion|null
     */
    private $localizacion;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $materialPadre;

    /**
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="materiales")
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id", nullable=true)
     * @var Persona|null
     */
    private $persona;

    /**
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="materialesResponsable")
     * @ORM\JoinColumn(name="responsable_id", referencedColumnName="id", nullable=true)
     * @var Persona|null
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumn(name="prestado_por_id", referencedColumnName="id", nullable=true)
     * @var Persona|null
     */
    private $prestadoPor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Historial", mappedBy="material")
     * @var Historial|null
     */
    private $historicos;

    public function __construct()
    {
        $this->historicos = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): Material
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): Material
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function getFechaHoraUltimoPrestamo(): ?\DateTime
    {
        return $this->fechaHoraUltimoPrestamo;
    }

    public function setFechaHoraUltimoPrestamo(?\DateTime $fechaHoraUltimoPrestamo): Material
    {
        $this->fechaHoraUltimoPrestamo = $fechaHoraUltimoPrestamo;
        return $this;
    }

    public function getFechaHoraUltimaDevolucion(): ?\DateTime
    {
        return $this->fechaHoraUltimaDevolucion;
    }

    public function setFechaHoraUltimaDevolucion(?\DateTime $fechaHoraUltimaDevolucion): Material
    {
        $this->fechaHoraUltimaDevolucion = $fechaHoraUltimaDevolucion;
        return $this;
    }

    public function isDisponible(): bool
    {
        return $this->disponible;
    }

    public function setDisponible(bool $disponible): Material
    {
        $this->disponible = $disponible;
        return $this;
    }

    public function getFechaAlta(): ?\DateTime
    {
        return $this->fechaAlta;
    }

    public function setFechaAlta(?\DateTime $fechaAlta): Material
    {
        $this->fechaAlta = $fechaAlta;
        return $this;
    }

    public function getFechaBaja(): ?\DateTime
    {
        return $this->fechaBaja;
    }

    public function setFechaBaja(?\DateTime $fechaBaja): Material
    {
        $this->fechaBaja = $fechaBaja;
        return $this;
    }

    public function getLocalizacion(): ?Localizacion
    {
        return $this->localizacion;
    }

    public function setLocalizacion(?Localizacion $localizacion): Material
    {
        $this->localizacion = $localizacion;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMaterialPadre()
    {
        return $this->materialPadre;
    }


    public function setMaterialPadre(bool $materialPadre)
    {
        $this->materialPadre = $materialPadre;
    }

    public function getPersona(): ?Persona
    {
        return $this->persona;
    }

    public function setPersona(?Persona $persona): Material
    {
        $this->persona = $persona;
        return $this;
    }

    public function getResponsable(): ?Persona
    {
        return $this->responsable;
    }

    public function setResponsable(?Persona $responsable): Material
    {
        $this->responsable = $responsable;
        return $this;
    }

    public function getPrestadoPor(): ?Persona
    {
        return $this->prestadoPor;
    }

    public function setPrestadoPor(?Persona $prestadoPor): Material
    {
        $this->prestadoPor = $prestadoPor;
        return $this;
    }

    /**
     * @return Historial|ArrayCollection|null
     */
    public function getHistoricos()
    {
        return $this->historicos;
    }

    /**
     * @param Historial|ArrayCollection|null $historicos
     * @return Material
     */
    public function setHistoricos($historicos)
    {
        $this->historicos = $historicos;
        return $this;
    }
}