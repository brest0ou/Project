<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('username', null,[
                'label' => 'Nom d\'utilisateur',
            ])

            ->add('email', EmailType::class,[
                'label' => 'Email',
            ])

            ->add('password', null,[
                'label' => 'Mot de passe',
            ])

            ->add('lastname', null,[
                'label' => 'Nom',
            ])

            ->add('firstname', null,[
                'label' => 'Prénom',
            ])

            ->add('picture', FileType::class,[
                'label' => 'Logo',
            ])

            ->add('roles', ChoiceType::class,[
                'choices' => 
                [
                 'dévellopeur' => 1,
                 'Visiteur' => 2
                ]
            ])
            ->add('createdat', DateType::class, array(
                'label' => 'Date de création du compte',
                'input' => 'datetime_immutable',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
