<?php

namespace App\Form;

use App\Entity\SousEmbranchement;
use App\Entity\Embranchement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SousEmbranchementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('vernaculaire')
            ->add('embranchement', EntityType::class, [
                'class' => Embranchement::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'mapped' => true,
                'required' => true, ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SousEmbranchement::class,
        ]);
    }
}
