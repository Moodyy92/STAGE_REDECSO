<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entreprise', CheckboxType::class, [
                'label' =>'Cocher si c\'est une entreprise  ',
                'required' => false,
            ])
            ->add('civilite', ChoiceType::class,[
                'choices' => [
                    ' ' => true, //Sélectionné par défaut
                    'Monsieur' => 'Monsieur',
                    'Madame' => 'Madame',
                ],
                'multiple' => false, //Met un select plutôt qu'un choix multiple
            ])
            ->add('nom', TextType::class,[
                'label' =>'',
                'attr' => [
                    'placeholder' => 'Nom'
                ],
                'required'=>true,
            ])
            ->add('prenom', TextType::class,[
                'label' =>'',
                'attr' => [
                    'placeholder' => 'Prenom'
                ],
                'required'=>false,
            ])

            ->add('adresse', TextType::class,[
                'label' =>'',
                'attr' => [
                    'placeholder' => 'Adresse'
                ],
                'error_bubbling' => false,
            ])
            ->add('cplt_adresse', TextType::class, [
                'label' =>'',
                'attr' => [
                    'placeholder' => 'Complément d adresse'
                ],
                'required'=>false,
            ])
            ->add('telephone', TelType::class,[
                'label' =>'',
                'attr' => [
                    'placeholder' => 'Numéro'
                ],
                'required'=>true,
            ])
            ->add('email',EmailType::class, [
                'label' =>'',
                'attr' => [
                    'placeholder' => 'Email'
                ],
                'required'=>true,
            ])
            ->add('codePostal',IntegerType::class, [
                'label' =>'',
                'attr' => [
                    'placeholder' => 'CP'
                ],
                'required'=>false,
            ])
            ->add('ville', TextType::class,[
                'label' =>'',
                'attr' => [
                    'placeholder' => 'Ville'
                ],
                'required'=>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
