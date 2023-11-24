<?php

namespace App\Controller;

use App\Repository\MaterialRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterialController extends AbstractController
{
    /**
     * @Route("/material", name="material_listar")
     */
    public function listarMaterial(MaterialRepository $materialRepository, Request $request, PaginatorInterface $paginator) : Response {
        $materiales = $materialRepository->findAll();

        $pagination = $paginator->paginate(
            $materiales,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('material/listar.html.twig', [
            'pagination' => $pagination
        ]);
    }
}