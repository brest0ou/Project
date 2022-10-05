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
                 'Dévellopeur' => "Développeur",
                 'Visiteur' => "Visiteur",
                ]
            ])
            ->add('createdat', DateType::class, array(
                'label' => 'Date de création du compte',
                'data' => new \DateTime(),
                
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            /*'attr' => [
                'novalidate' => 'novalidate', //on dit a google laisse moi envoyer mes donnée même si j'ai pas tout saisie ( c'est bien pour tester )
            ]*/
        ]);
    }
}
