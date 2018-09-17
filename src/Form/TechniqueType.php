<?php

namespace App\Form;

use App\Entity\Technique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TechniqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('player')
            ->add('catagory')
            ->add('video')
            ->add('cycle')
            ->add('startPosition')
            ->add('endPosition')
        ;
    }
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Technique::class,
        ]);
    }
}
