<?php

namespace App\Form;

use App\Entity\Material;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterialType extends AbstractType
{
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
            ->add('disponible', CheckboxType::class, [
                'label' => 'Disponible',
                'required' => false,
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();

                // PADRE CHECKED

                $tieneSubMateriales = !$data->getSubMateriales()->isEmpty();
                $isChecked = $tieneSubMateriales && $data->getId() !== null;

                $form->add('materialPadre', CheckboxType::class, [
                    'label' => '¿Es Material Padre?',
                    'required' => false,
                    'mapped' => false,
                    'data' => $isChecked,
                ]);

                // HIJOS CHECKBOX

                $subMateriales = $data->getSubMateriales();
                foreach ($subMateriales as $subMaterial) {
                    $form->add('subMaterial_' . $subMaterial->getId(), CheckboxType::class, [
                        'label' => $subMaterial->getNombre(),
                        'required' => false,
                        'mapped' => false,
                        'data' => true,
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