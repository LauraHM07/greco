<?php

namespace App\Form;

use App\Entity\Localizacion;
use App\Repository\LocalizacionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocalizacionType extends AbstractType
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

                // PADRE CHECKED

                $tieneLocalizacionPadre = $data->getLocalizacionPadre() !== null;
                $tieneSubLocalizaciones = !$data->getSubLocalizaciones()->isEmpty();
                $isChecked = $tieneSubLocalizaciones && $data->getId() !== null;

                $form->add('localizacionPadre', CheckboxType::class, [
                    'label' => '¿Es Localización Padre?',
                    'required' => false,
                    'mapped' => false,
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

                // LOCALIZACION PADRE SELECT

                $pisos = $this->localizacionRepository->findLocalizacionesSinPadre();
                $salas = $this->localizacionRepository->findLocalizacionesConPadreEHijos();

                dump($salas);

                if($tieneLocalizacionPadre) {
                    if($tieneSubLocalizaciones) {
                        $form->add('localizacionPadre', EntityType::class, [
                            'class' => Localizacion::class,
                            'choices' => $pisos,
                            'choice_label' => 'nombre',
                            'label' => 'Localización Padre',
                            'required' => false,
                        ]);
                    } else {
                        $form->add('localizacionPadre', EntityType::class, [
                            'class' => Localizacion::class,
                            'choices' => $salas,
                            'choice_label' => 'nombreCompleto',
                            'label' => 'Localización Padre',
                            'required' => false,
                        ]);
                    }
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