<?php

namespace App\Form;

use App\Entity\Localizacion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocalizacionType extends AbstractType
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
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();

                // PADRE CHECKED

                $localizacionPadre = $data->getLocalizacionPadre();
                $tieneSubLocalizaciones = !$data->getSubLocalizaciones()->isEmpty();
                $isChecked = $localizacionPadre === null || $tieneSubLocalizaciones;

                $form->add('localizacionPadre', CheckboxType::class, [
                    'label' => '¿Es Localización Padre?',
                    'required' => false,
                    'mapped' => false,
                    'attr' => [
                        'class' => 'mb-4',
                    ],
                    'data' => $isChecked,
                ]);

                // HIJAS CHECKBOX

                $subLocalizaciones = $data->getSubLocalizaciones();
                foreach ($subLocalizaciones as $subLocalizacion) {
                    $form->add('subLocalizacion_' . $subLocalizacion->getId(), CheckboxType::class, [
                        'label' => $subLocalizacion->getNombre(),
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
            'data_class' => Localizacion::class
        ]);
    }
}