<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add( 'roles', ChoiceType::class,[
                'attr' => ['class' => 'form-control'],
                'choices' => [
                    'Internaute'=> Utilisateur::ROLE_INTERNAUTE,
                    'Prestataire'=> Utilisateur::ROLE_PRESTATAIRE,
                ],
                'mapped' => false,
            ])
            ->add('eMail', EmailType::class, [
                'attr' => ['class' => 'form-control']
            ])
            /*
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            */
            ->add('password', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 12,
                    ]),
                ],

                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => ['class' => 'form-control'],
                ],
                'second_options' => [
                    'label' => 'Confirmation du mot de passe',
                    'attr' => ['class' => 'form-control'],
                ],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }


}
