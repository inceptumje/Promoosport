<?php

namespace App\Form;

use App\Entity\MatchFoot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

use App\Entity\League;
use App\Entity\Team;

class MatchFootType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('host', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'nom'
            ])
            ->add('guest', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'nom'
            ])
            ->add('league', EntityType::class, [
                'class' => League::class,
                'choice_label' => 'nom'
            ])
            ->add('date', DateTimeType::class , [
                'placeholder' => [
                    'year' => 'Year',
                    'month' => 'Month',
                    'day' => 'Day',
                    'hour' => 'Hour'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MatchFoot::class,
        ]);
    }
}
