<?php

namespace App\Form;

use App\Entity\Dossier;
use App\Entity\Serveur;
use App\Entity\Role;
use App\Repository\DossierRepository;
use App\Repository\ServeurRepository;
use App\Repository\RoleRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class dossierFormType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
       // ->add('nom', TextType::class, array('attr'=> array('readonly' => true)))
        ->add('nom', TextType::class)
            ->add('path')
            ->add('Serveur',EntityType::class,[
                "class"=>Serveur::class,
                "query_builder"=>function(ServeurRepository $serveurRepository){
                    return $serveurRepository->createQueryBuilder('c')
                        ->orderBy('c.NomServeur', 'ASC')
                        ->andWhere("c.NomServeur IS NOT NULL");
                },
                "required"=>false
            ])
            ->add('parent',EntityType::class,[
                "class"=>Dossier::class,
                "query_builder"=>function(DossierRepository $dossierRepository){
                    return $dossierRepository->createQueryBuilder('c')
                        ->orderBy('c.nom', 'ASC')
                        ->andWhere("c.deleted = false");
                },
                "required"=>false
            ])
            ->add('role', EntityType::class, [
                 
                'class' => Role::class,
                'multiple' => true,
                'mapped' => false/*,

                'query_builder' => function (RoledossierRepository $roledossierRepository) {
                        return $roledossierRepository->createQueryBuilder('a')
                            ->addSelect('c')
                            ->innerJoin('a.role', 'c')
                            ->orderBy('c.roleName');
                }*/])
            ->add('display')
    
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dossier::class,
        ]);
    }
    // TODO: Find a way to remove the edited cat. from the select

}
