<?php

namespace AppBundle\Form;

use AppBundle\Entity\Mensaje;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MensajeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('asunto', TextType::class, [
                'label' => 'Asunto'
            ])
            ->add('contenido', CKEditorType::class, [
                'label' => 'Contenido'
            ])
            ->add('mensajepara', NumberType::class, [
                'label' => 'Puntuación',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mensaje::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_mensaje_type';
    }
}
