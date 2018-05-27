<?php

namespace AppBundle\Form;

use AppBundle\Entity\Curriculum;
use Symfony\Component\Form\AbstractType;
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
            ->add('datos', TextType::class, [
            'label' => 'Datos Personales',
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
