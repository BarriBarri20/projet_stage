<?php

namespace App\Form;

use App\Entity\TypeServeur;
use App\Repository\TypeServeurRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeServeurFormType extends AbstractType
{

    public function __construct()
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codeType')
            ->add('Description')
            ->add('Protocol')
    
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TypeServeur::class,
        ]);
    }
    // TODO: Find a way to remove the edited cat. from the select

}
