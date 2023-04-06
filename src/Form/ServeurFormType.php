<?php

namespace App\Form;

use App\Entity\Serveur;
use App\Entity\TypeServeur;
use App\Repository\ServeurRepository;
use App\Repository\TypeServeurRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ServeurFormType extends AbstractType
{

 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomServeur')
            ->add('AdresseIP')
            ->add('Port')
            ->add('Ssl')
            ->add('typeServeur',EntityType::class,[
                "class"=>TypeServeur::class,
                "query_builder"=>function(TypeServeurRepository $typeServeurRepository){
                    return $typeServeurRepository->createQueryBuilder('c')
                        ->orderBy('c.codeType', 'ASC')
                        ->andWhere("c.codeType IS NOT NULL");
                },
                "required"=>false
            ])
  ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' =>Serveur::class,
        ]);
    }
    // TODO: Find a way to remove the edited cat. from the select

}
