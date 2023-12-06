<?php

namespace App\Repository;

use App\Entity\Persona;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PersonaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Persona::class);
    }

    public function eliminar(Persona $persona) : void
    {
        $this->getEntityManager()->remove($persona);
    }

    public function guardar(){
        $this->getEntityManager()->flush();
    }

    public function nuevo() : Persona{
        $persona = new Persona();
        $this->getEntityManager()->persist($persona);

        return $persona;
    }
}