<?php


namespace App\Controller;


use App\Entity\TypeServeur;
use App\Form\TypeServeurFormType;
use App\Repository\TypeServeurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TypeServeurController extends BaseController
{

    private $typeserveurRepository;
    private $entityManager;

    public function __construct(TypeServeurRepository $typeserveurRepository,EntityManagerInterface $entityManager)
    {
        $this->typeserveurRepository= $typeserveurRepository;
        $this->entityManager = $entityManager;
    }

        /**
     * @Route("/admin/typeserveur",name="app_admin_typeserveur")
     * @IsGranted("ROLE_SUPERUSER")
     */
    public function TypeServeur(){
        $typeserveurs =$this->typeserveurRepository->findall(); 
        return $this->render("admin/serveur/Typeserveur.html.twig",["typeserveurs"=> $typeserveurs]);   
    }

    
        /**
     * @Route("/admin/typeserveur/new",name="app_admin_new_typeserveur")
     * @IsGranted("ROLE_SUPERUSER")
     */
    public function newTypeServeur(Request $request){
        $form = $this->createForm(TypeServeurFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /** @var  TypeServeur $typeServeur*/
            $typeServeur = $form->getData();
            $this->entityManager->persist($typeServeur);
            $this->entityManager->flush();
            $this->addFlash("success","Type Serveur ajouté");
            return $this->redirectToRoute("app_admin_serveur");

        }
        return $this->render("admin/serveur/Typeserveurform.html.twig",["TypeServeurForm"=>$form->createView()]);
    }

     /**
     * @Route("/admin/typeserveur/edit/{id}",name="app_admin_edit_typeserveur")
     * @IsGranted("ROLE_SUPERUSER")
     */
    public function editServeur(TypeServeur $typeserveur,Request $request){
        $form = $this->createForm(TypeServeurFormType::class,$typeserveur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $typeserveur->setValid(true)
                ->setDeleted(false);
            $this->entityManager->persist($serveur);
            $this->entityManager->flush();
            $this->addFlash("success","type Serveur modifié");
            return $this->redirectToRoute("app_admin_typeserveur");
        }
        return $this->render("admin/serveur/TypeServeurform.html.twig",["TypeServeurForm"=>$form->createView()]);
    }
}

