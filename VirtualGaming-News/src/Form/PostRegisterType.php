<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null,[
                'label' => 'Titre Du Post'
            ])

            ->add('text', TextType::class,)

            ->add('picture', FileType::class,)

            ->add('status')

            ->add('grades', NumberType::class,)

            ->add('createdAt', DateType::class,[
                'label' => "Date de création",
                'input' => 'datetime_immutable',
            ])

            ->add('posts')

            ->add('gamesPosts')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
