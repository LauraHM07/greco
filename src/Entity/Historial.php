<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="historial")
 */
class Historial
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @var \DateTime
     */
    private $fechaHoraPrestramo;

    /**
     * @ORM\Column(type="date")
     * @var \DateTime
     */
    private $fechaHoraDevolucion;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    private $notas;

    public function getId(): int
    {
        return $this->id;
    }

    public function getFechaHoraPrestramo(): \DateTime
    {
        return $this->fechaHoraPrestramo;
    }

    public function setFechaHoraPrestramo(\DateTime $fechaHoraPrestramo): Historial
    {
        $this->fechaHoraPrestramo = $fechaHoraPrestramo;
        return $this;
    }

    public function getFechaHoraDevolucion(): \DateTime
    {
        return $this->fechaHoraDevolucion;
    }

    public function setFechaHoraDevolucion(\DateTime $fechaHoraDevolucion): Historial
    {
        $this->fechaHoraDevolucion = $fechaHoraDevolucion;
        return $this;
    }

    public function getNotas(): ?string
    {
        return $this->notas;
    }

    public function setNotas(?string $notas): Historial
    {
        $this->notas = $notas;
        return $this;
    }
}