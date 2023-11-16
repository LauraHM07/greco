<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
    public $id;

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
     * @var Material[]|Collection
     */
    private $materiales;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $localizacionPadre;

    public function __construct() {
        $this->materiales = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function setCodigo(?string $codigo): Localizacion
    {
        $this->codigo = $codigo;
        return $this;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): Localizacion
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): Localizacion
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    /**
     * @return Material[]|Collection
     */
    public function getMateriales()
    {
        return $this->materiales;
    }

    /**
     * @param Material[]|Collection $materiales
     * @return Localizacion
     */
    public function setMateriales($materiales)
    {
        $this->materiales = $materiales;
        return $this;
    }

    /**
     * @return bool
     */
    public function isLocalizacionPadre()
    {
        return $this->localizacionPadre;
    }

    /**
     * @param bool $localizacionPadre
     */
    public function setLocalizacionPadre(bool $localizacionPadre)
    {
        $this->localizacionPadre = $localizacionPadre;
    }
}