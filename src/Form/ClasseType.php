<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\SuperClasse;
use App\Entity\SousEmbranchement;
use App\Entity\Embranchement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('caracteres')
            ->add('vernaculaire')
            ->add('sous_embranchement', EntityType::class, [
                'class' => SousEmbranchement::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'mapped' => true,
                'required' => false, ])
            ->add('embranchement', EntityType::class, [
                'class' => Embranchement::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'mapped' => true,
                'required' => false, ])
                ->add('super_classe', EntityType::class, [
                    'class' => SuperClasse::class,
                    'choice_label' => 'nom',
                    'multiple' => false,
                    'mapped' => true,
                    'required' => false, ])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Classe::class,
        ]);
    }
}
