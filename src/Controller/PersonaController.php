<?php

namespace App\Controller;

use App\Repository\PersonaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonaController extends AbstractController
{
    /**
     * @Route("/persona", name="persona_listar")
     */
    public function listarPersona(PersonaRepository $personaRepository) : Response {
        $personas = $personaRepository->findAll();

        return $this->render('persona/listar.html.twig', [
            'personas' => $personas
        ]);
    }
}