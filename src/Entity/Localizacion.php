<?php

namespace App\Entity;

use App\Repository\LocalizacionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Faker\Factory;

/**
 * @ORM\Entity
 * @ORM\Table(name="localizacion")
 */
class Localizacion
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
    private $codigo;

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
     * @ORM\OneToMany(targetEntity="Material", mappedBy="localizacion")
     * @var Material[]|Collection|null
     */
    private $materiales;

    /**
     * @ORM\ManyToOne(targetEntity="Localizacion", inversedBy="subLocalizaciones")
     * @ORM\JoinColumn(name="localizacion_padre_id", referencedColumnName="id", nullable=true)
     * @var Localizacion|null
     */
    private $localizacionPadre;

    /**
     * @ORM\OneToMany(targetEntity="Localizacion", mappedBy="localizacionPadre", cascade={"remove"})
     * @var Localizacion[]|Collection
     */
    private $subLocalizaciones;

    public function __construct() {
        $this->materiales = new ArrayCollection();
        $this->subLocalizaciones = new ArrayCollection();
        $this->codigo = $this->generateUniqueCode();
    }

    // --------- GENERAR CÓDIGO CON REGEX AL CREAR UNA LOCALIZACIÓN

    private function generateUniqueCode(): string
    {
        $prefix = $this->generateRandomPrefix();
        $digits = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);

        return $prefix . $digits;
    }

    private function generateRandomPrefix(): string
    {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($letters), 0, 3);
    }

    public function __toString()
    {
        return $this->getNombre();
    }

    public function getNombreCompleto(): string
    {
        $nombreCompleto = $this->getNombre();

        if ($this->getLocalizacionPadre() !== null) {
            $nombreCompleto .= ' (' . $this->getLocalizacionPadre()->getNombre() . ')';
        }

        return $nombreCompleto;
    }

    // --------- ID

    public function getId(): ?int
    {
        return $this->id;
    }

    // --------- CÓDIGO

    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function setCodigo(?string $codigo): Localizacion
    {
        $this->codigo = $codigo;
        return $this;
    }

    // --------- NOMBRE

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): Localizacion
    {
        $this->nombre = $nombre;
        return $this;
    }

    // --------- DESCRIPCIÓN

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): Localizacion
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    // --------- LOCALIZACIÓN PADRE

    public function getLocalizacionPadre(): ?Localizacion
    {
        return $this->localizacionPadre;
    }

    public function setLocalizacionPadre(?Localizacion $localizacionPadre): Localizacion
    {
        $this->localizacionPadre = $localizacionPadre;
        return $this;
    }

    // --------- SUBLOCALIZACIÓN

    /**
     * @return Localizacion[]|ArrayCollection|Collection
     */
    public function getSubLocalizaciones()
    {
        return $this->subLocalizaciones;
    }

    /**
     * @param Localizacion[]|ArrayCollection|Collection $subLocalizaciones
     * @return Localizacion
     */
    public function setSubLocalizaciones($subLocalizaciones)
    {
        $this->subLocalizaciones = $subLocalizaciones;
        return $this;
    }

    // --------- MANTENIMIENTO SUBLOCALIZACIONES

    public function addSubLocalizacion(Localizacion $subLocalizacion): self
    {
        if (!$this->subLocalizaciones->contains($subLocalizacion)) {
            $this->subLocalizaciones[] = $subLocalizacion;
            $subLocalizacion->setLocalizacionPadre($this);
        }

        return $this;
    }

    public function removeSubLocalizacion(Localizacion $subLocalizacion): self
    {
        if ($this->subLocalizaciones->contains($subLocalizacion)) {
            $this->subLocalizaciones->removeElement($subLocalizacion);

            if ($subLocalizacion->getLocalizacionPadre() === $this) {
                $subLocalizacion->setLocalizacionPadre(null);
            }
        }

        return $this;
    }

    // --------- MATERIALES

    /**
     * @return Material[]|Collection|null
     */
    public function getMateriales()
    {
        return $this->materiales;
    }

    // --------- MANTENIMIENTO MATERIALES

    /**
     * Añade material a la localización
     * @param Material $material
     */
    public function addMaterial(Material $material)
    {
        $this->materiales->add($material);

        $material->setLocalizacion($this);
    }

    /**
     * Borra un material de la localización
     * @param Material $material
     */
    public function removeMaterial(Material $material)
    {
        $this->materiales->removeElement($material);

        $material->setLocalizacion(null);
    }
}