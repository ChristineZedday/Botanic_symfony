<?php

namespace App\Form;

use App\Entity\Photo;
use App\Entity\Genre;
use App\Entity\Espece;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('date')
            ->add('lieu')
            ->add('espece', EntityType::class, [
                'class' => Espece::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'mapped' => true,
                'required' => false, ])
                ->add('genre', EntityType::class, [
                    'class' => Genre::class,
                    'choice_label' => 'nom',
                    'multiple' => false,
                    'mapped' => true,
                    'required' => false, ])
                ->add('image', FileType::class, [
                        'label' => 'fichier à télécharger',
                        'multiple' => false,
                        'mapped' => false,
                        'required' => true, ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Photo::class,
        ]);
    }
}
