<?php

namespace App\Form;

use App\Entity\Annonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationAnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,['label'=>'title','required'=>true])
            ->add(
                'dogs', CollectionType::class,
                [
                    'entry_type' => DogType::class,
                    'label' => 'dogs',
                    'prototype_name' => 'dogs',
                    'allow_add' => true,
                    'by_reference' => false,
                    'entry_options' => ['label' => false],
                ]
            )
            ->add('isAvailable')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
