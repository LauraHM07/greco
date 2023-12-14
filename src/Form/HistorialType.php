<?php

namespace App\Form;

use App\Entity\Historial;
use App\Entity\Material;
use App\Entity\Persona;
use App\Repository\MaterialRepository;
use App\Repository\PersonaRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class HistorialType extends AbstractType
{
    private $materialRepository;
    private $personaRepository;
    private $security;

    public function __construct(MaterialRepository $materialRepository, PersonaRepository $personaRepository, Security $security)
    {
        $this->materialRepository = $materialRepository;
        $this->personaRepository = $personaRepository;
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $materiales = $this->materialRepository->findAll();
        $personas = $this->personaRepository->findAll();
        $gestores = $this->personaRepository->findAllPersonasGestor();
        $usuario = $this->security->getUser();

        $builder
            ->add('notas', TextareaType::class, [
                'label' => 'Notas',
                'required' => false
            ])
            ->add('material', EntityType::class, [
                'class' => Material::class,
                'choices' => $materiales,
                'choice_label' => 'nombre',
                'label' => 'Material',
                'required' => true,
                'placeholder' => false,
            ])
            ->add('prestadoA', EntityType::class, [
                'class' => Persona::class,
                'choices' => $personas,
                'choice_label' => 'nombre',
                'label' => 'Prestado a',
                'required' => true,
                'placeholder' => false,
            ])
            ->add('prestadoPor', EntityType::class, [
                'class' => Persona::class,
                'choices' => $gestores,
                'choice_label' => 'nombre',
                'label' => 'Prestado por',
                'data' => $usuario,
                'required' => true,
                'placeholder' => false
            ])
            ->add('fechaHoraPrestramo', DateType::class, [
                'widget' => 'choice',
                'label' => 'Fecha recogida',
                'format' => 'dd-MM-yyyy',
                'data' => new \DateTime(),
                'required' => true
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();

                $form->add('fechaHoraDevolucion', DateType::class, [
                    'widget' => 'choice',
                    'label' => 'Fecha devolución',
                    'format' => 'dd-MM-yyyy',
                    'data' => new \DateTime(),
                    'required' => true,
                    'disabled' => $data && $data->getId() == null,
                ]);
            });
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Historial::class,
        ]);
    }
}