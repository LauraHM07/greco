<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    /**
     * @Route ("", name="welcome")
     */
    public function index(): Response
    {
        $mensaje = 'Welcome';

        return $this->render('welcome/welcome.html.twig', [
            'mensaje' => $mensaje
        ]);
    }
}
