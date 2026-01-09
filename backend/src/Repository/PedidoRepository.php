<?php

namespace App\Repository;

use App\Entity\Pedido;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PedidoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pedido::class);
    }

    /**
     * Pedidos para el tablero de cocina (pendientes y en preparación)
     */
    public function findParaCocina(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.estado IN (:estados)')
            ->setParameter('estados', [Pedido::ESTADO_PENDIENTE, Pedido::ESTADO_EN_PREPARACION])
            ->orderBy('p.createdAt', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Pedidos de una mesa para calcular la cuenta
     */
    public function findByMesaParaCuenta(int $mesaId): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.mesa = :mesaId')
            ->andWhere('p.estado != :estadoEntregado')
            ->setParameter('mesaId', $mesaId)
            ->setParameter('estadoEntregado', Pedido::ESTADO_ENTREGADO)
            ->getQuery()
            ->getResult();
    }
}
