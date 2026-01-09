<?php

namespace App\Repository;

use App\Entity\Producto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Producto::class);
    }

    public function findActivos(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.activo = :activo')
            ->setParameter('activo', true)
            ->orderBy('p.nombre', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByCategoria(int $categoriaId): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.categoria = :categoriaId')
            ->andWhere('p.activo = :activo')
            ->setParameter('categoriaId', $categoriaId)
            ->setParameter('activo', true)
            ->getQuery()
            ->getResult();
    }
}
