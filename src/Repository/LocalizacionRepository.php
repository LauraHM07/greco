<?php

namespace App\Repository;

use App\Entity\Localizacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LocalizacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Localizacion::class);
    }

    public function eliminar(Localizacion $localizacion) : void
    {
        $this->getEntityManager()->remove($localizacion);
    }

    public function guardar(){
        $this->getEntityManager()->flush();
    }

    public function nueva() : Localizacion{
        $localizacion = new Localizacion();
        $this->getEntityManager()->persist($localizacion);

        return $localizacion;
    }

    public function findAllLocalizaciones()
    {
        return $this->createQueryBuilder('l')
            ->orderBy('l.nombre', 'ASC')
            ->getQuery()
            ->getResult();
    }
}