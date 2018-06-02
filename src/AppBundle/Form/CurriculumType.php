<?php

namespace AppBundle\Form;

use AppBundle\Entity\Curriculum;
use AppBundle\Entity\Provincia;
use Doctrine\ORM\EntityRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
            ->add('provincia', EntityType::class, [
                'label' => 'Provincia',
                'class' => Provincia::class,
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.nombre', 'ASC');
                },
                'choice_label' => 'nombre',
            ])
            ->add('fechanacimiento', DateType::class, [
                'label' => 'Fecha de Nacimiento',
                'format' => 'dd MM yyyy',
                'years' => range(date('Y'), date('Y') - 100),
                'required' => true,
            ])
            ->add('experiencias', CKEditorType::class, [
                'label' => 'Experiencia',
            ])
            ->add('formaciones', CKEditorType::class, [
                'label' => 'Formación Académica',
            ])
            ->add('lenguajes', CKEditorType::class, [
                'label' => 'Lenguajes de Programación',
            ])
            ->add('sistemas', CKEditorType::class, [
                'label' => 'Sistemas Operativos',
            ])
            ->add('basesdedatos', CKEditorType::class, [
                'label' => 'Bases de Datos',
            ])
            ->add('programacionweb', CKEditorType::class, [
                'label' => 'Programación/Diseño Web',
            ])
            ->add('compcomunicativas', CKEditorType::class, [
                'label' => 'Competencias Comunicativas'
            ])
            ->add('comporganizativas', CKEditorType::class, [
                'label' => 'Competencias Organizativas'
            ])
            ->add('comppersonales', CKEditorType::class, [
                'label' => 'Competencias Personales'
            ])
            ->add('infoadiccional', CKEditorType::class, [
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
