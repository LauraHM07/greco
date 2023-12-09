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

    public function findLocalizacionesSinPadre()
    {
        return $this->createQueryBuilder('l')
            ->where('l.localizacionPadre IS NULL')
            ->getQuery()
            ->getResult();
    }

    public function findLocalizacionesConPadreEHijos()
    {
        return $this->createQueryBuilder('l')
            ->where('l.localizacionPadre IS NOT NULL')
            ->andWhere('l.subLocalizaciones IS NOT EMPTY')
            ->getQuery()
            ->getResult();
    }
}