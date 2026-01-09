<?php

namespace App\Controller\Api;

use App\Entity\DetallePedido;
use App\Entity\Pedido;
use App\Repository\MesaRepository;
use App\Repository\ProductoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class PedidoController extends AbstractController
{
    #[Route('/pedido', name: 'api_crear_pedido', methods: ['POST'])]
    public function crearPedido(
        Request $request,
        MesaRepository $mesaRepository,
        ProductoRepository $productoRepository,
        EntityManagerInterface $em
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['mesa_token']) || !isset($data['items']) || empty($data['items'])) {
            return $this->json(['error' => 'Datos incompletos'], 400);
        }

        $mesa = $mesaRepository->findByToken($data['mesa_token']);

        if (!$mesa) {
            return $this->json(['error' => 'Mesa no encontrada'], 404);
        }

        if (!$mesa->isActiva()) {
            return $this->json(['error' => 'Mesa no disponible'], 403);
        }

        $pedido = new Pedido();
        $pedido->setMesa($mesa);
        $pedido->setEstado(Pedido::ESTADO_PENDIENTE);

        foreach ($data['items'] as $item) {
            if (!isset($item['producto_id']) || !isset($item['cantidad'])) {
                continue;
            }

            $producto = $productoRepository->find($item['producto_id']);
            
            if (!$producto || !$producto->isActivo()) {
                continue;
            }

            $detalle = new DetallePedido();
            $detalle->setPedido($pedido);
            $detalle->setProducto($producto);
            $detalle->setCantidad((int) $item['cantidad']);
            
            if (isset($item['notas'])) {
                $detalle->setNotas($item['notas']);
            }

            $pedido->addDetalle($detalle);
        }

        if ($pedido->getDetalles()->isEmpty()) {
            return $this->json(['error' => 'No hay productos válidos en el pedido'], 400);
        }

        $pedido->calcularTotal();

        $em->persist($pedido);
        $em->flush();

        return $this->json([
            'success' => true,
            'pedido' => [
                'id' => $pedido->getId(),
                'estado' => $pedido->getEstado(),
                'total' => $pedido->getTotalCalculado(),
                'created_at' => $pedido->getCreatedAt()->format('Y-m-d H:i:s'),
            ],
        ], 201);
    }

    #[Route('/pedido/{id}', name: 'api_ver_pedido', methods: ['GET'])]
    public function verPedido(Pedido $pedido): JsonResponse
    {
        $detalles = [];
        
        foreach ($pedido->getDetalles() as $detalle) {
            $detalles[] = [
                'producto' => $detalle->getProducto()->getNombre(),
                'cantidad' => $detalle->getCantidad(),
                'precio_unitario' => $detalle->getPrecioUnitario(),
                'subtotal' => $detalle->getSubtotal(),
                'notas' => $detalle->getNotas(),
            ];
        }

        return $this->json([
            'id' => $pedido->getId(),
            'mesa' => $pedido->getMesa()->getNumero(),
            'estado' => $pedido->getEstado(),
            'total' => $pedido->getTotalCalculado(),
            'created_at' => $pedido->getCreatedAt()->format('Y-m-d H:i:s'),
            'detalles' => $detalles,
        ]);
    }
}
