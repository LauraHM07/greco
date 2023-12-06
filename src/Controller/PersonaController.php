<?php

namespace App\Controller;

use App\Entity\Persona;
use App\Form\PersonaType;
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
}