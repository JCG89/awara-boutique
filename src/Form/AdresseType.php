<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nomAdresse', TextType::class, [
                'label' => ' Votre adresse?',
                'attr' => [
                    'placeholder' => 'Nom de votre adresse'
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => ' Nom',
                'attr' => [
                    'placeholder' => 'Votre nom'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => ' Prenom',
                'attr' => [
                    'placeholder' => 'Votre prenom'
                ]
            ])
            ->add('entreprise', TextType::class, [
                'label' => 'Entreprise',
                'attr' => [
                    'placeholder' => 'Votre entreprise(facultatif'
                ]
            ])
            ->add('adresse', TextType::class, [
                'label' => ' Adresse',
                'attr' => [
                    'placeholder' => 'Votre adresse de livraison'
                ]
            ])
            ->add('codePostal', TextType::class, [
                'label' => ' Code postal',
                'attr' => [
                    'placeholder' => 'Exple 94500 '
                ]
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville ',
                'attr' => [
                    'placeholder' => 'Votre ville de residence'
                ]
            ])
            ->add('pays', CountryType::class, [
                'label' => ' Pays',
                'attr' => [
                    'placeholder' => 'Votre pays '
                ]
            ])
            ->add('telephone', TelType::class, [
                'label' => ' Téléphone',
                'attr' => [
                    'placeholder' => 'Votre numéro de téléphone'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn-block btn-info'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}