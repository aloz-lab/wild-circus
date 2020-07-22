<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Show;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('picture')
            ->add('summary')
            ->add('show_date')
            ->add('adult_price')
            ->add('child_price')
            ->add('group_price')
            ->add('artists')
        ;
        $builder->add('artists', EntityType::class, [
            'class' => Artist::class,
            'choice_label' => 'name',
            'expanded' => true,
            'multiple' => true,
            'by_reference' => false
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Show::class,
        ]);
    }
}
