<?php

namespace App\Controller;

use App\Entity\Persona;
use App\Form\CambiarPasswordType;
use App\Form\PersonaType;
use App\Repository\PersonaRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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

    /**
     * @Route("/persona/nueva", name="persona_nueva")
     */
    public function nuevo(Request $request, PersonaRepository $personaRepository) : Response {
        $persona = $personaRepository->nuevo();

        return $this->modificar($request, $persona, $personaRepository);
    }

    /**
     * @Route("/persona/{id}", name="persona_modificar")
     */
    public function modificar(Request $request, Persona $persona, PersonaRepository $personaRepository) : Response {
        $form = $this->createForm(PersonaType::class, $persona);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            try {
                $personaRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con exito');
                return $this->redirectToRoute('persona_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('persona/modificar.html.twig', [
            'persona' => $persona,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/persona/eliminar/{id}", name="persona_eliminar")
     */
    public function eliminar(PersonaRepository $personaRepository, Request $request, Persona $persona) : Response {
        if ($request->get('confirmar')) {
            try {
                $personaRepository->eliminar($persona);
                $personaRepository->guardar();
                $this->addFlash('exito', 'Persona eliminada con éxito');
                return $this->redirectToRoute('persona_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar!');
            }
        }
        return $this->render('persona/eliminar.html.twig', [
            'persona' => $persona
        ]);
    }

    /**
     * @Route("persona/clave/{id}", name="persona_cambiar_clave")
     */
    public function cambiarPasswordEmpleado(Request $request, UserPasswordEncoderInterface $passwordEncoder, PersonaRepository $repository, Persona $persona): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USUARIO');

        $form = $this->createForm(CambiarPasswordType::class, $persona, [
            'admin' => $this->isGranted('ROLE_ADMIN')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $persona->setClave(
                    $passwordEncoder->encodePassword(
                        $persona, $form->get('nuevaClave')->get('first')->getData()
                    )
                );

                $repository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');

                return $this->redirectToRoute('persona_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('persona/cambiarClave.html.twig', [
            'persona' => $this->getUser(),
            'form' => $form->createView()
        ]);
    }
}