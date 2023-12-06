<?php

namespace App\Controller;

use App\Entity\Localizacion;
use App\Form\LibroModificarType;
use App\Form\LocalizacionType;
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

    /**
     * @Route("/localizacion/nueva", name="localizacion_nueva")
     */
    public function nueva(Request $request, LocalizacionRepository $localizacionRepository) : Response {
        $localizacion = $localizacionRepository->nueva();

        return $this->modificar($request, $localizacion, $localizacionRepository);
    }

    /**
     * @Route("/localizacion/{id}", name="localizacion_modificar")
     */
    public function modificar(Request $request, Localizacion $localizacion, LocalizacionRepository $localizacionRepository) : Response {
        $form = $this->createForm(LocalizacionType::class, $localizacion);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            try {
                $localizacionRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con exito');
                return $this->redirectToRoute('localizacion_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('localizacion/modificar.html.twig', [
            'localizacion' => $localizacion,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/localizacion/eliminar/{id}", name="localizacion_eliminar")
     */
    public function eliminar(LocalizacionRepository $localizacionRepository, Request $request, Localizacion $localizacion) : Response {
        if ($request->get('confirmar')) {
            try {
                $localizacionRepository->eliminar($localizacion);
                $localizacionRepository->guardar();
                $this->addFlash('exito', 'Localización eliminada con éxito');
                return $this->redirectToRoute('localizacion_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar!');
            }
        }
        return $this->render('localizacion/eliminar.html.twig', [
            'localizacion' => $localizacion
        ]);
    }
}