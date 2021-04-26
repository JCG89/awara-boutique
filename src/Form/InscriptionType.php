<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('prenom', TextType::class, [
                'label' => 'Prenom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30
                ]),
                'attr' => [
                    'placeholder' => ' Votre prenom s\'il vous plait'
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30
                ]),
                'attr' => [
                    'placeholder' => 'Votre nom s\'il vous plait'
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30
                ]),
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Votre email s\'il vous plait'
                ]
            ])
            ->add('password', RepeatedType::class, [

                'type' => PasswordType::class,

                'invalid_message' => 'le mot de passe et la confirmation doivent être identiques!',

                'label' => 'Mot de passe',

                'required' => true,

                'first_options' => [
                    'label' => 'Mot de passe',

                    'attr' => [
                        'placeholder' => 'Votre mot de passe'
                    ]

                ],

                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                    'attr' => [
                        'placeholder' => 'Confirmez votre mot de passe'
                    ]

                ]

            ])

            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => [
                    'class' => 'btn btn-primary btn-block'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}