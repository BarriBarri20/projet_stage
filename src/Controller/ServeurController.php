<?php


namespace App\Controller;


use App\Entity\Serveur;
use App\Form\ServeurFormType;
use App\Repository\ServeurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ServeurController extends BaseController
{

    private $serveurRepository;
    private $entityManager;

    public function __construct(ServeurRepository $serveurRepository,EntityManagerInterface $entityManager)
    {
        $this->serveurRepository = $serveurRepository;
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/admin/serveur",name="app_admin_serveur")
     * @IsGranted("ROLE_SUPERUSER")
     */
    public function serveurs(){
        $serveurs = $this->serveurRepository->findAll();
        return $this->render("admin/serveur/serveur.html.twig",["serveurs"=>$serveurs]);
    }

   
    
 /**
     * @Route("/admin/serveur/new",name="app_admin_new_serveur")
     * @IsGranted("ROLE_SUPERUSER")
     */
    public function newServeur(Request $request){
        $form = $this->createForm(ServeurFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /** @var  Serveur $Serveur*/
            $Serveur = $form->getData();
            $this->entityManager->persist($Serveur);
            $this->entityManager->flush();
            $this->addFlash("success","Serveur ajouté");
            return $this->redirectToRoute("app_admin_serveur");

        }
        return $this->render("admin/serveur/Serveurform.html.twig",["ServeurForm"=>$form->createView()]);
    }

     /**
     * @Route("/admin/serveur/edit/{id}",name="app_admin_edit_serveur")
     * @IsGranted("ROLE_SUPERUSER")
     */
    public function editServeur(Serveur $serveur,Request $request){
        $form = $this->createForm(ServeurFormType::class,$serveur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $serveur->setValid(true)
                ->setDeleted(false);
            $this->entityManager->persist($serveur);
            $this->entityManager->flush();
            $this->addFlash("success","Serveur modifié");
            return $this->redirectToRoute("app_admin_serveur");
        }
        return $this->render("admin/serveur/Serveurform.html.twig",["ServeurForm"=>$form->createView()]);
    }
    
}
