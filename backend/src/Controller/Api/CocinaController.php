<?php

namespace App\Controller\Api;

use App\Entity\Pedido;
use App\Repository\PedidoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/cocina')]
class CocinaController extends AbstractController
{
    #[Route('/pedidos', name: 'api_cocina_pedidos', methods: ['GET'])]
    public function getPedidos(PedidoRepository $pedidoRepository): JsonResponse
    {
        $pedidos = $pedidoRepository->findParaCocina();
        $data = [];

        foreach ($pedidos as $pedido) {
            $detalles = [];
            
            foreach ($pedido->getDetalles() as $detalle) {
                $detalles[] = [
                    'id' => $detalle->getId(),
                    'producto' => $detalle->getProducto()->getNombre(),
                    'cantidad' => $detalle->getCantidad(),
                    'notas' => $detalle->getNotas(),
                ];
            }

            $data[] = [
                'id' => $pedido->getId(),
                'mesa' => $pedido->getMesa()->getNumero(),
                'estado' => $pedido->getEstado(),
                'created_at' => $pedido->getCreatedAt()->format('Y-m-d H:i:s'),
                'tiempo_espera' => $this->calcularTiempoEspera($pedido),
                'prioridad' => $this->calcularPrioridad($pedido),
                'detalles' => $detalles,
            ];
        }

        return $this->json($data);
    }

    #[Route('/pedido/{id}/estado', name: 'api_cambiar_estado', methods: ['PATCH'])]
    public function cambiarEstado(
        Pedido $pedido,
        Request $request,
        EntityManagerInterface $em
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['estado'])) {
            return $this->json(['error' => 'Estado no especificado'], 400);
        }

        $estadosValidos = [
            Pedido::ESTADO_PENDIENTE,
            Pedido::ESTADO_EN_PREPARACION,
            Pedido::ESTADO_LISTO,
            Pedido::ESTADO_ENTREGADO,
        ];

        if (!in_array($data['estado'], $estadosValidos)) {
            return $this->json(['error' => 'Estado no válido'], 400);
        }

        $pedido->setEstado($data['estado']);
        $em->flush();

        return $this->json([
            'success' => true,
            'pedido' => [
                'id' => $pedido->getId(),
                'estado' => $pedido->getEstado(),
            ],
        ]);
    }

    private function calcularTiempoEspera(Pedido $pedido): int
    {
        $ahora = new \DateTimeImmutable();
        $diferencia = $ahora->getTimestamp() - $pedido->getCreatedAt()->getTimestamp();
        
        return (int) floor($diferencia / 60); // Minutos
    }

    private function calcularPrioridad(Pedido $pedido): string
    {
        $minutos = $this->calcularTiempoEspera($pedido);

        if ($minutos < 10) {
            return 'verde';
        } elseif ($minutos < 20) {
            return 'amarillo';
        } else {
            return 'rojo';
        }
    }
}
