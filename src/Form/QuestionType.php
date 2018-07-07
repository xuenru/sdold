<?php

namespace App\Form;

use App\Entity\Level;
use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('options', CollectionType::class, [
                'entry_type'    => OptionType::class,
                'entry_options' => ['label' => false],
                'by_reference'  => false,
                'allow_add'     => true,
                'allow_delete'  => true,
            ])
            ->add('answer')
            ->add('level', ChoiceType::class, [
                'choices' => [
                    'débutant'      => 1,
                    'intermédiaire' => 2,
                    'avancé'        => 3,
                ],
            ])
            ->add('Submit', SubmitType::class, ['attr' => ['class' => 'btn btn-success']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
