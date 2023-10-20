<?php

namespace App\Controller;

use App\Repository\MaterialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterialController extends AbstractController
{
    /**
     * @Route("/material", name="material_listar")
     */
    public function listarMaterial(MaterialRepository $materialRepository) : Response {
        $materiales = $materialRepository->findAll();

        return $this->render('material/listar.html.twig', [
            'materiales' => $materiales
        ]);
    }
}