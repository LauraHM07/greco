<?php

namespace App\Controller;

use App\Entity\Material;
use App\Form\MaterialType;
use App\Repository\MaterialRepository;
use Endroid\QrCode\Builder\BuilderInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterialController extends AbstractController
{
    /**
     * @Route("/material", name="material_listar")
     * @Security("is_granted('ROLE_USUARIO')")
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
     * @Route("/material/disponible", name="material_disponible_listar")
     * @Security("is_granted('ROLE_USUARIO')")
     */
    public function listarMaterialDisponible(MaterialRepository $materialRepository, Request $request, PaginatorInterface $paginator) : Response {
        $materiales = $materialRepository->findAllMaterialesDisponibles();

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
     * @Route("/material/noDisponible", name="material_noDisponible_listar")
     * @Security("is_granted('ROLE_USUARIO')")
     */
    public function listarMaterialNoDisponible(MaterialRepository $materialRepository, Request $request, PaginatorInterface $paginator) : Response {
        $materiales = $materialRepository->findAllMaterialesNoDisponibles();

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
     * @Security("is_granted('ROLE_GESTOR')")
     */
    public function nuevo(Request $request, MaterialRepository $materialRepository) : Response {
        $material = $materialRepository->nuevo();
        $material->setDisponible(1);

        return $this->modificar($request, $material, $materialRepository);
    }

    /**
     * @Route("/material/{id}", name="material_modificar")
     * @Security("is_granted('ROLE_GESTOR')")
     */
    public function modificar(Request $request, Material $material, MaterialRepository $materialRepository) : Response {
        $form = $this->createForm(MaterialType::class, $material);
        $subMateriales = $material->getSubMateriales();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            try {
                $material->setDisponible($material->isDisponible());

                if ($material->isDisponible()) {
                    foreach ($subMateriales as $subMaterial) {
                        $subMaterial->setDisponible(true);
                    }
                }

                $materialRepository->guardar();
                flash()->addSuccess('Cambios guardados con éxito.');

                return $this->redirectToRoute('material_listar');
            } catch (\Exception $e) {
                flash()->addError('Ha ocurrido un error. Contacte el Administrador.');
            }
        }
        return $this->render('material/modificar.html.twig', [
            'material' => $material,
            'subMateriales' => $subMateriales,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/material/eliminar/{id}", name="material_eliminar")
     * @Security("is_granted('ROLE_GESTOR')")
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

    /**
     * @Route ("/codigos", name="codigos")
     */
    public function codigos(MaterialRepository $materialRepository, BuilderInterface $qrBuilder): Response
    {
        $materiales = $materialRepository->findAll();

        $qrResult = $qrBuilder
            ->size(300)
            ->margin(20)
            ->data('https://www.youtube.com/watch?v=_tee_eoVSj8&ab_channel=LatteAndCode')
            ->build();
        $base = $qrResult->getDataUri();

        return $this->render('material/listar_codigos.html.twig', [
            'materiales' => $materiales,
            'base' => $base
        ]);
    }
}