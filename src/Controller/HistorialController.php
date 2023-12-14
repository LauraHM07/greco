<?php

namespace App\Controller;

use App\Entity\Historial;
use App\Form\HistorialType;
use App\Repository\HistorialRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
     * @Security("is_granted('ROLE_GESTOR')")
     */
    public function nuevo(Request $request, HistorialRepository $historialRepository) : Response {
        $historial = $historialRepository->nuevo();

        return $this->modificar($request, $historial, $historialRepository);
    }

    /**
     * @Route("/historial/{id}", name="historial_modificar")
     * @Security("is_granted('ROLE_GESTOR')")
     */
    public function modificar(Request $request, Historial $historial, HistorialRepository $historialRepository) : Response {
        $form = $this->createForm(HistorialType::class, $historial);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            try {
                $material = $historial->getMaterial();
                $materialPadre = $material->getMaterialPadre();

                if($historial->getFechaHoraDevolucion() == null) {
                    $material->setDisponible(false);
                } else {
                    if($materialPadre) {
                        foreach ($materialPadre->getSubMateriales() as $subMaterial) {
                            $subMaterial->setDisponible(true);
                        }
                    }
                    $material->setDisponible(true);
                }

                try {
                    $this->getDoctrine()->getManager()->flush();
                } catch (\Exception $e) {
                    dump($e->getMessage());
                }

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
}