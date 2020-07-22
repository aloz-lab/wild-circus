<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Show;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('picture')
            ->add('presentation')
            ->add('shows')
            ->add('shows', EntityType::class, [
                'class' => Show::class,
                'choice_label' => 'title',
                'expanded' => true,
                'multiple' => true,
                'by_reference' => false
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}
