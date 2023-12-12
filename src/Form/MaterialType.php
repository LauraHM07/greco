<?php

namespace App\Form;

use App\Entity\Localizacion;
use App\Entity\Material;
use App\Repository\LocalizacionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterialType extends AbstractType
{
    private $localizacionRepository;

    public function __construct(LocalizacionRepository $localizacionRepository)
    {
        $this->localizacionRepository = $localizacionRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', null, [
                'label' => 'Nombre',
                'required' => true,
            ])
            ->add('descripcion', null, [
                'label' => 'Descripción',
                'required' => false
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();

                $localizaciones = $this->localizacionRepository->findAllLocalizacionesMuebles();

                // Si no existen datos, significa que el form está vacío ===> Crear nuevo material
                if (!$data || null === $data->getId()) {
                    $form->add('localizacion', EntityType::class, [
                        'class' => Localizacion::class,
                        'choices' => $localizaciones,
                        'choice_label' => 'nombreCompleto',
                        'label' => 'Localización',
                        'required' => false,
                    ]);
                } else {
                    $tieneSubMateriales = !$data->getSubMateriales()->isEmpty();
                    $isChecked = $tieneSubMateriales && $data->getId() !== null;

                    $form->add('materialPadre', CheckboxType::class, [
                        'label' => '¿Es Material Padre?',
                        'required' => false,
                        'mapped' => false,
                        'data' => $isChecked,
                    ]);
                }
            });
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Material::class,
        ]);
    }
}