<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
            ->add('price', MoneyType::class,[
                'label' => 'Prix ' ,
            ])
            ->add('totalWeight')
            ->add('duration', NumberType::class,[
                'label' => 'Durée du jeux'
            ])
            ->add('picture', FileType::class,[
                'label' => 'Logo du Jeu'
            ])
            ->add('description', TextType::class,[
                'label' => "Description du jeux"
            ])
            ->add('develop', FileType::class,[
                'label' => 'Fichier :',
                'block_name' => 'file'
            ])
            ->add('status', ChoiceType::class,[
                'label' => 'Stade de dévellopement du jeux :',
                'choices' => 
                [
                 'Version Alpha' => "Version Alpha",
                 'Version Bêta' => "Version Bêta",
                ]
            ])
            ->add('createdat', DateType::class, array(
                'label' => "Date de création",
                'input' => 'datetime_immutable',
            ))
            ->add('updateat',DateType::class,  array(
                'label' => "Date de Prochaine mise à jour",
                'input' => 'datetime_immutable',
            ))
            ->add('gamesCategory' )

            ->add('users', null, [
                'label' => 'créateur',
                'choice_label' => 'username',
                'expanded' => true,
                'attr' => [
                    'class' => 'checkbox-list'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
            /*'attr' => [
                'novalidate' => 'novalidate',
            ]*/
        ]);
    }
}
