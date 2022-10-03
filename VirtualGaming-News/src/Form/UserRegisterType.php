<?php

namespace App\Form;

use App\Entity\User;
use phpDocumentor\Reflection\PseudoType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('roles')

            ->add('username', null,[
                'label' => 'Nom d\'utilisateur',
            ])


            ->add('email', EmailType::class,[
                'label' => 'Email',
            ])

            ->add('password', PseudoType::class,[
                'label' => 'Mot de passe',
            ])

            ->add('lastname', null,[
                'label' => 'Nom',
            ])

            ->add('firstname', null,[
                'label' => 'Prénom',
            ])

            ->add('isEnable', null,)

            ->add('picture', FileType::class,[
                'label' => 'Logo',
            ])

            ->add('createdAt')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
