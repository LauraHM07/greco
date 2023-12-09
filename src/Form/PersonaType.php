<?php

namespace App\Form;

use App\Entity\Persona;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\NotBlank;

class PersonaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreUsuario', null, [
                'label' => 'Usuario',
                'required' => true,
            ])
            ->add('nombre', null, [
                'label' => 'Nombre',
                'required' => true,
            ])
            ->add('apellidos', null, [
                'label' => 'Apellidos',
                'required' => true,
            ])
            ->add('administrador', CheckboxType::class, [
                'label' => 'Administrador',
                'required' => false,
            ])
            ->add('gestorPrestamos', CheckboxType::class, [
                'label' => 'Gestor de Préstamos',
                'required' => false,
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Persona::class,
            'gestor_prestamos' => false,
            'administrador' => false
        ]);
    }
}