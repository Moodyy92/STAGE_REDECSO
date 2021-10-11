<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Produit;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class,[
                'attr' => [
                    'placeholder' => 'Nom'
                ],
                'label' =>'',
                'required'=>true,])
            ->add('prix', NumberType::class,[
                'attr' => [
                    'placeholder' => 'Prix'
                ],
                'label' =>'',
                'scale'=>2,
            ])

            ->add('marque', EntityType::class,[
                'class' => Marque::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('m')
                        ->orderBy('m.libelle', 'ASC');
                },
                'choice_label' => 'libelle',
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
