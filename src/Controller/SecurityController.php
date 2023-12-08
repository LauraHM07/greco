<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="inicio")
     */
    public function inicio()
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('entrar');
        }

        return $this->render('welcome/welcome.html.twig');
    }

    /**
     * @Route("/entrar", name="entrar")
     */
    public function loginAction(AuthenticationUtils $authenticationUtils) : Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'error' => $error,
            'ultimo_usuario' => $lastUsername
        ]);
    }

    /**
     * @Route("/salir", name="salir")
     */
    public function logout()
    {
    }
}