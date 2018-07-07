<?php

namespace App\Form;

use App\Entity\Level;
use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = $options['entity_manager'];
        $levels = $entityManager->getRepository(Level::class)->findLevelList();
        $builder
            ->add('description')
            ->add('answer')
            ->add('level', ChoiceType::class, ['choices' => $levels]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
        $resolver->setRequired('entity_manager');
    }
}

