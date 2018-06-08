<?php

namespace AppBundle\Form;

use AppBundle\Entity\Pdf;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PdfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pdfde', NumberType::class, [
                'label' => 'Puntuación'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pdf::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_pdf_type';
    }
}
