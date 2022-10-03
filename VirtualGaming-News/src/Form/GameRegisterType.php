<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom du jeu' ,
            ])
            ->add('price', null,[
                'label' => 'Prix' ,
            ])
            ->add('totalWeight')
            ->add('duration', FileType::class,[
                'label' => 'Fichier:'
            ])
            ->add('picture', FileType::class,[
                'label' => 'Logo du Jeu'
            ])
            ->add('description', TextType::class,[
                'label' => "Description du jeux"
            ])
            ->add('develop')
            ->add('status')
            // ->add('createdAt')
            // ->add('updateAt')
            ->add('users', TextType::class)
            ->add('gamesCategory' )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
