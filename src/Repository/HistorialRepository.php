<?php

namespace App\Repository;

use App\Entity\Historial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class HistorialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Historial::class);
    }

    public function eliminar(Historial $historial) : void
    {
        $this->getEntityManager()->remove($historial);
    }

    public function guardar(){
        $this->getEntityManager()->flush();
    }

    public function nuevo() : Historial{
        $historial = new Historial();
        $this->getEntityManager()->persist($historial);

        return $historial;
    }
}