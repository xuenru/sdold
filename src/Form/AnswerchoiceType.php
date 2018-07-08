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
            ->add('lable', ChoiceType::class, [
                'choices' => [
                    'A' => 'A',
                    'B' => 'B',
                    'C' => 'C',
                    'D' => 'D',
                    'E' => 'E',
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
