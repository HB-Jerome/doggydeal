<?php

namespace App\Form;

use App\Entity\AdoptionOffer;
use App\Entity\Dog;
use App\Form\AdoptantType;
use App\Form\MessageType;
use App\Repository\DogRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Collection;

class AdoptionOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $id = $options['id'];
        $builder
            ->add('dogs', EntityType::class, [
                'class' => Dog::class,
                'multiple' => true,
                'choice_label' => 'name',
                'expanded' => true,
                'query_builder' => function (DogRepository $dr)use ($id) {
                    return $dr->createQueryBuilder('d')
                        ->join('d.annonce', 'a')
                        ->Where('a.id = :id')
                        ->andWhere('d.isAdopted = FALSE')
                        ->setParameter('id', $id)
                    ;}
                ])
            ->add('adoptant', AdoptantType::class)
            ->add('messages', CollectionType::class, [
                'entry_type' => MessageType::class,
                'entry_options' =>['label'=> false],
                'label' => 'Message'
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ]);
            ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdoptionOffer::class,
             'id'=> null
        ]);
    }
}
