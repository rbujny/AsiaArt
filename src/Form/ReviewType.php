<?php

namespace App\Form;

use App\Entity\Review;
use App\Repository\ItemRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder,array $options): void
    {
        $builder
            ->add('username')
            ->add('rating', IntegerType::class, [
                'constraints' => [
                    new Range([
                        "min" => 1,
                        "max" => 5,
                    ])
                ]
            ])
            ->add('review');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }

}
