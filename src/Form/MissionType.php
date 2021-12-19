<?php

namespace App\Form;

use App\Entity\Mission;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('priority', ChoiceType::class, [
                'choices' => [
                    'Low' => 'low_priority',
                    'Medium' => 'medium_priority',
                    'High' => 'high_priority'
                ]
            ])
            ->add('completion_date', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'To do' => 'to_do',
                    'In progress' => 'in_progress',
                    'Done' => 'done'
                ]
            ])
            ->add('superHeroes', EntityType::class, [
                'class' => User::class,
                'choices' => $options['superHeroes'],
                'choice_label' => function($choice) {
                    return $choice->getUsername();
                },
                'multiple' => true,
                'expanded' => true,
                'error_bubbling' => true,
            ])
            ->add('submit', SubmitType::class, ['label' => 'Create a mission'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
            'superHeroes' => [],
        ]);
    }
}
