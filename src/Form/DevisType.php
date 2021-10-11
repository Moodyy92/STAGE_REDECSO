<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Devis;
use Doctrine\ORM\EntityRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //TODO rajouter un autocomplite pour la selection des clients
            ->add('client', EntityType::class,[
                'class' => Client::class,
                'attr'=>[
                    'class' => 'choice-search'
                    ],

                'multiple' => false,
                'expanded' => false,
                'choice_label' => function($client){
                    return
                        $client->getPrenom() ?                           // ?= if, then, (condition turner)
                        strtoupper($client->getNom())
                        .' '.
                        ucfirst( strtolower($client->getPrenom())) :     // := else (condition turner)
                        strtoupper($client->getNom());
                },
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('client')
                        ->orderBy('client.nom','ASC')
                        ->orderBy('client.prenom','ASC');
                },
                'required'=>true,
            ])
            ->add('date', DateType::class,[
//                'placeholder' => [
//                    'day' => 'Day','month' => 'Month','year' => 'Year',
//                ],
                'label' =>'Date de création :',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'html5' => true,
            ])
            ->add('objet', TextType::class,[
                'label' =>'',
                'attr' => [
                    'placeholder' => 'Ex: Intervention Plomberie'
                ],
                'required'=>true,
            ])
            ->add('ref', TextType::class,[
                'label' =>'',
                'attr' => [
                    'placeholder' => 'Ex: Adresse, contacte, tel... '
                ],
                'required'=>true,
            ])
//            ->add('signature', TextType::class,[
//                'label' =>'',
//                'attr' => [
//                    'placeholder' => 'Nom'
//                ],
//                'required'=>true,
//            ])
//            ->add('descriptif', TextType::class,[
//                'label' =>'',
//                'attr' => [
//                    'placeholder' => 'Nom'
//                ],
//                'required'=>true,
//            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Devis::class,
        ]);
    }
}
