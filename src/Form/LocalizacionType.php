<?php

namespace App\Form;

use App\Entity\Localizacion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocalizacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', null, ['required' => true])
            ->add('descripcion', null, ['required' => false])
            ->add('localizacionPadre', CheckboxType::class, [
                'label' => 'Localizacion Padre',
                'required' => false,
                'value' => 1,
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Localizacion::class,
        ]);
    }
}