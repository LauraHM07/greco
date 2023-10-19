<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="persona")
 */
class Persona
{

    /**
     * @ORM\Id
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
    public function getNombreUsuario(): string
    {
        return $this->nombreUsuario;
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

}