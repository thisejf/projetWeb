<?php

namespace App\Form;

use App\Entity\Internaute;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
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
            ->add('newsLetter', ChoiceType::class,[
                'attr' => ['class' => 'form-check'],
                'label' => 'Newsletter',
                'required'=>false,
                'expanded'=>true,
                'multiple'=>true,
                'choices' => ['yes' => true],
                'mapped'=>false
            ])
            //->add('image')
            //->add('position')
            //>add('prestataires')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Internaute::class,
        ]);
    }
}
