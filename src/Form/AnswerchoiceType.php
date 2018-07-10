<?php

namespace App\Form;

use App\Entity\Answerchoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnswerchoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $choices)
    {
        $builder
            ->add('label', ChoiceType::class, [
                'choices' => [
                    'A' => '1',
                    'B' => '2',
                    'C' => '3',
                    'D' => '4',
                    'E' => '5',
                ],
            ])
            ->add('description')
            ->add('isRight');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Answerchoice::class,
        ]);
    }
}
