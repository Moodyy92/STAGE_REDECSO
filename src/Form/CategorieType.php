<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Marque;
use App\Entity\Tache;
use Doctrine\ORM\EntityRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('categorie')
            ->add('libelle', TextType::class,[
                'label' =>'',
                'attr' => [
                    'placeholder' => 'Ex: Electricité'
                ],
                'required'=>true,])

//            ->add('taches',EntityType::class,[
//        'taches' => Tache::class,
////        'query_builder' => function (EntityRepository $tr) {
////            return $tr->createQueryBuilder('t')
////                ->orderBy('t.libelle', 'ASC');
////        },
//        'choice_label' => 'taches',
//    ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
