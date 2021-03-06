<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Department;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, 
            [
                'required'   => true,
                'constraints' => [
                    new Email,
                    new NotBlank,
                ],
                "label" => "Email"
            ])
            ->add('password', RepeatedType::class, 
            [
                'type' => PasswordType::class,
                'invalid_message' => 'Les deux mots de passe ne sont pas identiques',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Répéter votre mot de passe'],
                
            ])
            ->add('firstname', TextType::class,
                [
                    "label" => "Prénom"
                ])
            ->add('lastname', TextType::class,
                [
                    "label" => "Nom"
                ])
            ->add('gender', ChoiceType::class, 
            [
                "label" => "Genre",
                'choices'  => 
                ['Choisir' => 
                [
                    'Madame' => "Madame",
                    'Monsieur' => "Monsieur",
                ]
                ]
                ])
            ->add('address', TextareaType::class,
            [
                "label" => "Adresse"
                ])
            ->add('postalcode', TelType::class,
            [
                "label" => "Code postal"
            ])
            ->add('city', TextType::class,
                [
                    "label" => "Ville"
                ]
            )
            ->add('department', EntityType::class, [
                "label" => "Département",
                "class" => Department::class,
                "choice_label" => "number",
                "by_reference" => false
                ])
            ->add('mobilephone', TelType::class,
                [
                    "label" => "Numéro de téléphone portable",
                    'help' => 'Au format 06123456789 ou 07123456789',
                ]
                )
            ->add('otherphone', TelType::class, [
                    "label" => "Autre numéro de téléphone",
                ]
            );
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
