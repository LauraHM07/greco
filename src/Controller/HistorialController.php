<?php

namespace App\Controller;

use App\Entity\Historial;
use App\Form\HistorialType;
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

    /**
     * @Route("/historial/nuevo", name="historial_nuevo")
     */
    public function nuevo(Request $request, HistorialRepository $historialRepository) : Response {
        $historial = $historialRepository->nuevo();

        return $this->modificar($request, $historial, $historialRepository);
    }

    /**
     * @Route("/historial/{id}", name="historial_modificar")
     */
    public function modificar(Request $request, Historial $historial, HistorialRepository $historialRepository) : Response {
        $form = $this->createForm(HistorialType::class, $historial);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            try {
                $historialRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con exito');
                return $this->redirectToRoute('historial_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('historial/modificar.html.twig', [
            'historial' => $historial,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/historial/eliminar/{id}", name="historial_eliminar")
     */
    public function eliminar(HistorialRepository $historialRepository, Request $request, Historial $historial) : Response {
        if ($request->get('confirmar')) {
            try {
                $historialRepository->eliminar($historial);
                $historialRepository->guardar();
                $this->addFlash('exito', 'Historial eliminado con éxito');
                return $this->redirectToRoute('historial_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar!');
            }
        }
        return $this->render('historial/eliminar.html.twig', [
            'historial' => $historial
        ]);
    }
}