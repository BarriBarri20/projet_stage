<?php

namespace App\Form;

use App\Entity\Role;
use App\Repository\RoleRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoleFormType extends AbstractType
{

    public function __construct()
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roleName')
            ->add('libelle')
    
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Role::class,
        ]);
    }
    // TODO: Find a way to remove the edited cat. from the select

}
