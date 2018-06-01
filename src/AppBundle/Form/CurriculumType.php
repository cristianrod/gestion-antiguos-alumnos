<?php

namespace AppBundle\Form;

use AppBundle\Entity\Curriculum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CurriculumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('direccion', TextType::class, [
                'label' => 'Dirección'
            ])
            ->add('poblacion', TextType::class, [
                'label' => 'Población'
            ])
            ->add('fechanacimiento', DateType::class, [
                'label' => 'Fecha de Nacimiento',
                'format' => 'dd MM yyyy',
                'years' => range(date('Y'), date('Y') - 100),
                'required' => true,
            ])
            ->add('experiencias', CollectionType::class, [
                'label' => false,
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'entry_options' => ['label' => false],
            ])
            ->add('formaciones', CollectionType::class, [
                'label' => false,
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'entry_options' => ['label' => false],
            ])
            ->add('lenguajes', CollectionType::class, [
                'label' => false,
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'entry_options' => ['label' => false],
            ])
            ->add('sistemas', CollectionType::class, [
                'label' => false,
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'entry_options' => ['label' => false],
            ])
            ->add('basesdedatos', CollectionType::class, [
                'label' => false,
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'entry_options' => ['label' => false],
            ])
            ->add('programacionweb', CollectionType::class, [
                'label' => false,
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'entry_options' => ['label' => false],
            ])
            ->add('compcomunicativas', TextareaType::class, [
                'label' => 'Competencias Comunicativas'
            ])
            ->add('comporganizativas', TextareaType::class, [
                'label' => 'Competencias Organizativas'
            ])
            ->add('comppersonales', TextareaType::class, [
                'label' => 'Competencias Personales'
            ])
            ->add('infoadiccional', TextareaType::class, [
                'label' => 'Información Adiccional'
            ])
            ->add('sexo', ChoiceType::class, [
                'label' => 'Sexo',
                'choices' => [
                    'Hombre' => 'Hombre',
                    'Mujer' => 'Mujer'
                ],
                'expanded' => true,
            ])
            ->add('crearcv', SubmitType::class, [
                'label' => 'Crear Curriculum',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Curriculum::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_curriculum_type';
    }
}
