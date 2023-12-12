<?php

namespace App\Controller;

use App\Entity\Localizacion;
use App\Form\LocalizacionType;
use App\Repository\LocalizacionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("is_granted('ROLE_ADMIN')")
 */
class LocalizacionController extends AbstractController
{
    /**
     * @Route("/localizacion", name="localizacion_listar")
     * @Security("is_granted('ROLE_ADMIN')")
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
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function nueva(Request $request, LocalizacionRepository $localizacionRepository) : Response {
        try {
            $localizacion = $localizacionRepository->nueva();
            $error = null;
        } catch (\Exception $e) {
            $localizacion = null;
            $error = 'An error occurred: ' . $e->getMessage();
        }

        return $this->modificar($request, $localizacion, $localizacionRepository, $error);
    }

    /**
     * @Route("/localizacion/{id}", name="localizacion_modificar")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function modificar(Request $request, Localizacion $localizacion, LocalizacionRepository $localizacionRepository, $error = null) : Response {
        $form = $this->createForm(LocalizacionType::class, $localizacion);
        $subLocalizaciones = $localizacion->getSubLocalizaciones();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $localizacionRepository->guardar();

                flash()->addSuccess('Cambios guardados con éxito.');

                return $this->redirectToRoute('localizacion_listar');
            } catch (\Exception $e) {
                flash()->addError('Ha ocurrido un error. Contacte el Administrador.');
            }
        }

        return $this->render('localizacion/modificar.html.twig', [
            'localizacion' => $localizacion,
            'subLocalizaciones' => $subLocalizaciones,
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }

    /**
     * @Route("/localizacion/eliminar/{id}", name="localizacion_eliminar")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function eliminar(LocalizacionRepository $localizacionRepository, Request $request, Localizacion $localizacion) : Response {
        if ($request->get('confirmar')) {
            try {
                $localizacionRepository->eliminar($localizacion);
                $localizacionRepository->guardar();

                flash()->addSuccess('Localización eliminada con éxito.');

                return $this->redirectToRoute('localizacion_listar');
            } catch (\Exception $e) {
                flash()->addError('Ha ocurrido un error. Contacte el Administrador.');
            }
        }
        return $this->render('localizacion/eliminar.html.twig', [
            'localizacion' => $localizacion
        ]);
    }
}