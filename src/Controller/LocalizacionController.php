<?php

namespace App\Controller;

use App\Repository\LocalizacionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocalizacionController extends AbstractController
{
    /**
     * @Route("/localizacion", name="localizacion_listar")
     */
    public function listarLocalizacion(LocalizacionRepository $localizacionRepository, Request $request, PaginatorInterface $paginator) : Response {
        $localizaciones = $localizacionRepository->findAll();

        $pagination = $paginator->paginate(
            $localizaciones,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('localizacion/listar.html.twig', [
            'pagination' => $pagination
        ]);
    }
}