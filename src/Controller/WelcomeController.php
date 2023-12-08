<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("is_granted('ROLE_USUARIO')")
 */
class WelcomeController extends AbstractController
{
    /**
     * @Route ("/inicio", name="welcome")
     */
    public function index(): Response
    {
        return $this->render('welcome/welcome.html.twig');
    }
}
