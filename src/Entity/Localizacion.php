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
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $localizacionPadre;

    public function __construct() {
        $this->materiales = new ArrayCollection();
        $this->codigo = $this->generateUniqueCode();
    }

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

    public function getId(): ?int
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
     * @return Material[]|Collection|null
     */
    public function getMateriales()
    {
        return $this->materiales;
    }

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