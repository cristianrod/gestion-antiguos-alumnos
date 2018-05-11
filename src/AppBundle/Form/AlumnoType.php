<?php

namespace AppBundle\Form;

use AppBundle\Entity\Alumno;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlumnoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('username', TextType::class, [
                'label' => 'Usuario'
            ])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Repetir Contraseña'),
            ))
            ->add('nif', TextType::class, [
                'label' => 'NIF',
            ])
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
            ])
            ->add('apellido1', TextType::class, [
                'label' => '1º Apellido'
            ])
            ->add('apellido2', TextType::class, [
                'label' => '2º Apellido',
            ])
            ->add('movil', TextType::class, [
                'label' => 'Móvil'
            ])
            ->add('registrarse', SubmitType::class, [
                'label' => 'Registrarse',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Alumno::class,
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_alumno_type';
    }
}
