<?php

namespace App\Controller\Api;

use App\Repository\CategoriaRepository;
use App\Repository\MesaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class CartaController extends AbstractController
{
    #[Route('/mesa/{token}/carta', name: 'api_carta', methods: ['GET'])]
    public function getCarta(
        string $token,
        MesaRepository $mesaRepository,
        CategoriaRepository $categoriaRepository
    ): JsonResponse {
        $mesa = $mesaRepository->findByToken($token);

        if (!$mesa) {
            return $this->json(['error' => 'Mesa no encontrada'], 404);
        }

        if (!$mesa->isActiva()) {
            return $this->json(['error' => 'Mesa no disponible'], 403);
        }

        $categorias = $categoriaRepository->findAllOrdered();
        $carta = [];

        foreach ($categorias as $categoria) {
            $productosData = [];
            
            foreach ($categoria->getProductos() as $producto) {
                if (!$producto->isActivo()) {
                    continue;
                }

                $alergenosData = [];
                foreach ($producto->getAlergenos() as $alergeno) {
                    $alergenosData[] = [
                        'id' => $alergeno->getId(),
                        'nombre' => $alergeno->getNombre(),
                        'icono' => $alergeno->getIcono(),
                    ];
                }

                $productosData[] = [
                    'id' => $producto->getId(),
                    'nombre' => $producto->getNombre(),
                    'descripcion' => $producto->getDescripcion(),
                    'precio' => $producto->getPrecio(),
                    'imagen' => $producto->getImagen(),
                    'alergenos' => $alergenosData,
                ];
            }

            if (count($productosData) > 0) {
                $carta[] = [
                    'id' => $categoria->getId(),
                    'nombre' => $categoria->getNombre(),
                    'descripcion' => $categoria->getDescripcion(),
                    'productos' => $productosData,
                ];
            }
        }

        return $this->json([
            'mesa' => [
                'id' => $mesa->getId(),
                'numero' => $mesa->getNumero(),
            ],
            'categorias' => $carta,
        ]);
    }
}
