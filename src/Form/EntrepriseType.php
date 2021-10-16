<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('siret')
            ->add('adresse')
            ->add('email')
            ->add('ville')
            ->add('cp')
            ->add('telephone')
            ->add('capital')
            ->add('codeAPE')
            ->add('numTVAIntracommunautaire')
            ->add('codeBanque')
            ->add('codeGuichet')
            ->add('codeBIC')
            ->add('numCompte')
            ->add('cleCompte')
            ->add('domiciliationCompte')
            ->add('IBAN')
            ->add('logo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
