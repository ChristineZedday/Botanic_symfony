<?php

namespace App\Form;

use App\Entity\Ordre;
use App\Entity\Classe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\SousClasse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('vernaculaire')
            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'mapped' => true,
                'required' => false, ])
        ->add('sous_classe', EntityType::class, [
            'class' => SousClasse::class,
            'choice_label' => 'nom',
            'multiple' => false,
            'mapped' => true,
            'required' => false, ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ordre::class,
        ]);
    }
}
