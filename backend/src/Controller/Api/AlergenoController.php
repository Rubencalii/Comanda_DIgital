<?php

namespace App\Controller\Api;

use App\Repository\AlergenoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class AlergenoController extends AbstractController
{
    #[Route('/alergenos', name: 'api_alergenos', methods: ['GET'])]
    public function getAlergenos(AlergenoRepository $alergenoRepository): JsonResponse
    {
        $alergenos = $alergenoRepository->findAll();
        $data = [];

        foreach ($alergenos as $alergeno) {
            $data[] = [
                'id' => $alergeno->getId(),
                'nombre' => $alergeno->getNombre(),
                'icono' => $alergeno->getIcono(),
            ];
        }

        return $this->json($data);
    }
}
