<?php

namespace App\Entity;

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
}