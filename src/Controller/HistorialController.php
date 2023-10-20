<?php

namespace App\Controller;

use App\Repository\HistorialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistorialController extends AbstractController
{
    /**
     * @Route("/historial", name="historial_listar")
     */
    public function listarHistorial(HistorialRepository $historialRepository) : Response {
        $historiales = $historialRepository->findAll();

        return $this->render('historial/listar.html.twig', [
            'historiales' => $historiales
        ]);
    }
}