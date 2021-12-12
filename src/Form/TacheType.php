<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Entity\Tache;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextareaType::class, [
                'label' => '',
                'attr' => [
                    'placeholder' => 'Ex: blabla'
                ],
                'required' => true,
            ])
            ->add('nbProduit', null, [
                'label' =>  'Quantité',
                'attr'  => [
                    'min'   =>  0
                ],
            ])
            ->add('prix', NumberType::class, [
                'attr' => [
                    'placeholder' => 'Prix'
                ],
                'label' => '',
                'scale' => 2,
            ])
//            ->add('categories', EntityType::class, [
//                'class' => Categorie::class,
//                'attr' => [
//                    'class' => 'choice-search'
//                ],
//                'multiple' => true,
//                'expanded' => false,
//                'choice_label' => function ($categorie) {
//                    return strtoupper($categorie->getLibelle());
//                },
//                'query_builder' => function (CategorieRepository $cr) {
//                    return $cr->createQueryBuilder('categorie')
//                        ->orderBy('categorie.libelle','ASC');
//                },
//                'required' => true,
//            ])
            ->add('produit', EntityType::class, [
                'class' => Produit::class,
                'attr' => [
                    'class' => 'choice-search-produit w-100 text-dark',
                    'style' => 'width: 100%;',
                ],
                'multiple' => false,
                'expanded' => false,
                'choice_label' => function ($produit) {
                    return strtoupper($produit->getLibelle());
                },
                'query_builder' => function (ProduitRepository $pr) {
                    return $pr->createQueryBuilder('produit')
                        ->orderBy('produit.libelle', 'ASC');
                },
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
        ]);
    }
}

