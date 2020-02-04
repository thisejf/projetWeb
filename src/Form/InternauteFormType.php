<?php

namespace App\Form;

use App\Entity\CodePostal;
use App\Entity\Commune;
use App\Entity\Internaute;
use App\Entity\Localite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InternauteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('eMail', EmailType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Email',
                'required'=>true
            ])
            ->add('nom', TextType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'Nom',
                'required'=>false
            ])
            ->add('prenom', TextType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'Prénom',
                'required'=>false
            ])
            ->add('adresseRue', TextType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'Rue',
                'required'=>false
            ])
            ->add('adresseNumero', NumberType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'Numéro de Rue',
                'required'=>false
            ])
            ->add('codePostal', EntityType::class,[
                'class'=>CodePostal::class,
                'choice_label'=>'codePostal',
                'attr' => ['class' => 'form-control'],
                'label' => 'Code postal',
                'expanded'=>false,
                'multiple'=>false,
                'mapped'=>true,
                'required'=>false
            ])
            ->add('localite', EntityType::class,[
                'class'=>Localite::class,
                'choice_label'=>'localite',
                'attr' => ['class' => 'form-control'],
                'label' => 'Localité',
                'expanded'=>false,
                'multiple'=>false,
                'mapped'=>true,
                'required'=>false
            ])
            ->add('commune', EntityType::class,[
                'class'=>Commune::class,
                'choice_label'=>'commune',
                'attr' => ['class' => 'form-control'],
                'label' => 'Commune',
                'expanded'=>false,
                'multiple'=>false,
                'mapped'=>true,
                'required'=>false
            ])
            ->add('newsLetter', ChoiceType::class,[
                'attr' => ['class' => 'form-check'],
                'label' => 'Newsletter',
                'required'=>false,
                'expanded'=>true,
                'multiple'=>true,
                'choices' => ['yes' => true],
                'mapped'=>false
            ])
            ->add('image', FileType::class, [
                'label' => 'Image de profil',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/gif',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Internaute::class,
        ]);
    }
}
