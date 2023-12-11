<?php

namespace App\Controller;

use App\Entity\Material;
use App\Form\MaterialType;
use App\Repository\MaterialRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("is_granted('ROLE_USUARIO')")
 */
class MaterialController extends AbstractController
{
    /**
     * @Route("/material", name="material_listar")
     */
    public function listarMaterial(MaterialRepository $materialRepository, Request $request, PaginatorInterface $paginator) : Response {
        $materiales = $materialRepository->findAll();

        $pagination = $paginator->paginate(
            $materiales,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('material/listar.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/material/nuevo", name="material_nuevo")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function nuevo(Request $request, MaterialRepository $materialRepository) : Response {
        $material = $materialRepository->nuevo();

        return $this->modificar($request, $material, $materialRepository);
    }

    /**
     * @Route("/material/{id}", name="material_modificar")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function modificar(Request $request, Material $material, MaterialRepository $materialRepository) : Response {
        $form = $this->createForm(MaterialType::class, $material);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {
            try {
                $material->setDisponible($material->isDisponible());
                $materialRepository->guardar();

                flash()->addSuccess('Cambios guardados con éxito.');

                return $this->redirectToRoute('material_listar');
            } catch (\Exception $e) {
                flash()->addError('Ha ocurrido un error. Contacte el Administrador.');
            }
        }
        return $this->render('material/modificar.html.twig', [
            'material' => $material,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/material/eliminar/{id}", name="material_eliminar")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function eliminar(MaterialRepository $materialRepository, Request $request, Material $material) : Response {
        if ($request->get('confirmar')) {
            try {
                $materialRepository->eliminar($material);
                $materialRepository->guardar();

                flash()->addSuccess('Cambios guardados con éxito.');

                return $this->redirectToRoute('material_listar');
            } catch (\Exception $e) {
                flash()->addError('Ha ocurrido un error. Contacte el Administrador.');
            }
        }
        return $this->render('material/eliminar.html.twig', [
            'material' => $material
        ]);
    }
}