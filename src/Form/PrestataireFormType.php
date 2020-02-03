<?php

namespace App\Form;

use App\Entity\CategorieDeServices;
use App\Entity\Prestataire;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrestataireFormType extends AbstractType
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
            ->add('eMailContact',EmailType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Email public',
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
            ->add('codePostal', NumberType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'Code postal',
                'required'=>false
            ])
            ->add('localite', TextType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'Localité',
                'required'=>false
            ])
            ->add('commune', TextType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'Commune',
                'required'=>false
            ])
            ->add('numTel',TextType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'numéro de téléphone',
                'required'=>false
            ])
            ->add('numTVA',TextType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'numéro de TVA',
                'required'=>false
            ])
            ->add('siteInternet',TextType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'Site Web',
                'required'=>false
            ])
            ->add('categorieDeServices', EntityType::class, [
                'class'=>CategorieDeServices::class,
                'choice_label'=>'nom',
                'attr' => ['class' => 'form-check'],
                'label' => 'Categorie de services',
                'required'=>false,
                'expanded'=>true,
                'multiple'=>true,
                'mapped'=>true,
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
            //todo modification et oubli mot de passe
            //->add('password')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prestataire::class,
        ]);
    }
}
