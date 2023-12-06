<?php

namespace App\Form;

use App\Entity\Persona;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\NotBlank;

class CambiarPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['admin'] === false) {
            $builder
                ->add('claveAntigua', PasswordType::class, [
                    'label' => 'Clave actual',
                    'required' => false,
                    'mapped' => false,
                    'constraints' => [
                        new UserPassword(),
                        new NotBlank()
                    ]
                ]);
        }

        $builder
            ->add('nuevaClave', RepeatedType::class, [
                'label' => 'Nueva clave',
                'required' => true,
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'No coinciden las claves',
                'first_options' => [
                    'label' => 'Nueva clave',
                    'constraints' => [
                        new NotBlank([
                            'groups' => ['password']
                        ])
                    ]
                ],
                'second_options' => [
                    'label' => 'Repite nueva clave',
                    'required' => true
                ]
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