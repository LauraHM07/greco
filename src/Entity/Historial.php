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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Persona", inversedBy="prestamosRealizados")
     * @ORM\JoinColumn(name="prestado_por_id", referencedColumnName="id")
     * @var Persona|null
     */
    private $prestadoPor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Persona", inversedBy="prestamosRecibidos")
     * @ORM\JoinColumn(name="prestado_a_id", referencedColumnName="id")
     * @var Persona|null
     */
    private $prestadoA;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Persona", inversedBy="devoluciones")
     * @ORM\JoinColumn(name="devuelto_por_id", referencedColumnName="id")
     * @var Persona|null
     */
    private $devueltoPor;

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

    public function getPrestadoPor(): ?Persona
    {
        return $this->prestadoPor;
    }

    public function setPrestadoPor(?Persona $prestadoPor): Historial
    {
        $this->prestadoPor = $prestadoPor;
        return $this;
    }

    public function getPrestadoA(): ?Persona
    {
        return $this->prestadoA;
    }

    public function setPrestadoA(?Persona $prestadoA): Historial
    {
        $this->prestadoA = $prestadoA;
        return $this;
    }

    public function getDevueltoPor(): ?Persona
    {
        return $this->devueltoPor;
    }

    public function setDevueltoPor(?Persona $devueltoPor): Historial
    {
        $this->devueltoPor = $devueltoPor;
        return $this;
    }
}