<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\JoinColumn(name="localizacion_id", referencedColumnName="id", onDelete="SET NULL")
     * @var Localizacion|null
     */
    private $localizacion;

    /**
     * @ORM\ManyToOne(targetEntity="Material", inversedBy="subMaterial")
     * @ORM\JoinColumn(name="material_padre_id", referencedColumnName="id", nullable=true)
     * @var Material|null
     */
    private $materialPadre;

    /**
     * @ORM\OneToMany(targetEntity="Material", mappedBy="materialPadre", cascade={"remove"})
     * @var Material[]|Collection
     */
    private $subMateriales;

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
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="materialesPrestados")
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
        $this->subMateriales = new ArrayCollection();
    }

    // --------- ID

    public function getId(): ?int
    {
        return $this->id;
    }

    // --------- NOMBRE

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): Material
    {
        $this->nombre = $nombre;
        return $this;
    }

    // --------- DESCRIPCIÓN

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): Material
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    // --------- FECHAS

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

    // --------- DISPONIBLE

    public function isDisponible(): bool
    {
        if (!$this->disponible) {
            return false;
        }

        foreach ($this->getSubMateriales() as $subMaterial) {
            if (!$subMaterial->isDisponible()) {
                return false;
            }
        }

        return true;
    }

    public function setDisponible(bool $disponible): Material
    {
        if ($this->disponible !== $disponible) {

            if (!$disponible) {
                foreach ($this->getSubMateriales() as $subMaterial) {
                    $subMaterial->setDisponible($disponible);
                }
            }

            $this->disponible = $disponible;
        }

        return $this;
    }

    // --------- FECHAS

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

    // --------- LOCALIZACIÓN

    public function getLocalizacion(): ?Localizacion
    {
        return $this->localizacion;
    }

    public function setLocalizacion(?Localizacion $localizacion): Material
    {
        $this->localizacion = $localizacion;

        return $this;
    }

    // --------- MATERIAL PADRE

    public function getMaterialPadre(): ?Material
    {
        return $this->materialPadre;
    }

    public function setMaterialPadre(?Material $materialPadre): Material
    {
        $this->materialPadre = $materialPadre;
        return $this;
    }

    // --------- SUBMATERIALES

    /**
     * @return Material[]|ArrayCollection|Collection
     */
    public function getSubMateriales()
    {
        return $this->subMateriales;
    }

    /**
     * @param Material[]|ArrayCollection|Collection $subMateriales
     * @return Material
     */
    public function setSubMateriales($subMateriales)
    {
        $this->subMateriales = $subMateriales;
        return $this;
    }

    // --------- MANTENIMIENTO SUBMATERIALES

    public function addSubMaterial(Material $subMaterial): self
    {
        if (!$this->subMateriales->contains($subMaterial)) {
            $this->subMateriales[] = $subMaterial;
            $subMaterial->setMaterialPadre($this);
        }

        return $this;
    }

    public function removeSubMaterial(Material $subMaterial): self
    {
        if ($this->subMateriales->contains($subMaterial)) {
            $this->subMateriales->removeElement($subMaterial);

            if ($subMaterial->getMaterialPadre() === $this) {
                $subMaterial->setMaterialPadre(null);
            }
        }

        return $this;
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