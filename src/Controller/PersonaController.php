<?php

namespace App\Controller;

use App\Repository\PersonaRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonaController extends AbstractController
{
    /**
     * @Route("/persona", name="persona_listar")
     */
    public function listarPersona(PersonaRepository $personaRepository, Request $request, PaginatorInterface $paginator) : Response {
        $personas = $personaRepository->findAll();

        $pagination = $paginator->paginate(
            $personas,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('persona/listar.html.twig', [
            'pagination' => $pagination
        ]);
    }
}