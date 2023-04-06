<?php

namespace App\Form;

use App\Entity\Roledossier;
use App\Repository\RoledossierRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoledossierFormType extends AbstractType
{

    public function __construct()
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id')
            ->add('Roles')

    
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Roledossier::class,
        ]);
    }
    // TODO: Find a way to remove the edited cat. from the select

}
