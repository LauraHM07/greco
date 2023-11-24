<?php

namespace App\Controller;

use App\Repository\HistorialRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistorialController extends AbstractController
{
    /**
     * @Route("/historial", name="historial_listar")
     */
    public function listarHistorial(HistorialRepository $historialRepository, Request $request, PaginatorInterface $paginator) : Response {
        $historiales = $historialRepository->findAll();

        $pagination = $paginator->paginate(
            $historiales,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('historial/listar.html.twig', [
            'pagination' => $pagination
        ]);
    }
}