<?php

namespace App\Form;

use App\Entity\Dog;
use App\Entity\Race;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('antecedant')
            ->add('isAdopted')
            ->add('acceptAnimmals')
            ->add('isLof')
            ->add(
                'races', EntityType::class,
                [
                    'choice_label' => 'name',
                    'class' => Race::class,
                    'multiple' => true,
                    'expanded' => true,
                ]
            )
            // ->add(
            //     'image', CollectionType::class,
            //     [
            //         'entry_type' => ImageType::class,
            //         'label' => 'Images',
            //         'prototype_name' => '__pictures__',
            //         'allow_add' => true,
            //         'by_reference' => false,
            //         'entry_options' => ['label' => false],
            //     ]
            // )
    ;}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dog::class,
        ]);
    }
}
