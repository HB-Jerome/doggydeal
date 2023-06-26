<?php

namespace App\Form;

use App\Entity\Adoptant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AdoptantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse e-mail',
                'invalid_message' => 'L\'adresse e-mail saisie est invalide.',
            ])
            ->add('city')
            ->add('phone')
            ->add('zipCode')
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'pattern' => '^[a-zA-Z]+$',
                    'title' => 'Seuls les caractères alphabétiques sont autorisés.',
                ],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'pattern' => '^[a-zA-Z]+$',
                    'title' => 'Seuls les caractères alphabétiques sont autorisés.',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adoptant::class,
        ]);
    }
}
