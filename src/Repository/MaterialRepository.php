<?php

namespace App\Repository;

use App\Entity\Material;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MaterialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Material::class);
    }

    public function eliminar(Material $material) : void
    {
        $this->getEntityManager()->remove($material);
    }

    public function guardar(){
        $this->getEntityManager()->flush();
    }

    public function nuevo() : Material{
        $material = new Material();
        $this->getEntityManager()->persist($material);

        return $material;
    }

    public function findAllMaterialesPadre()
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.nombre', 'ASC')
            ->where('m.subMateriales IS NOT EMPTY')
            ->getQuery()
            ->getResult();
    }

    public function findAllMaterialesDisponibles()
    {
        return $this->createQueryBuilder('m')
            ->where('m.disponible = true')
            ->getQuery()
            ->getResult();
    }

    public function findAllMaterialesNoDisponibles()
    {
        return $this->createQueryBuilder('m')
            ->where('m.disponible != true')
            ->getQuery()
            ->getResult();
    }
}