<?php


namespace App\Controller;


use App\Entity\Dossier;
use App\Entity\Roledossier;
use App\Form\dossierFormType;
use App\Repository\DossierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;

class dossierController extends BaseController
{

    private $dossierRepository;
        private $entityManager;

    public function __construct(DossierRepository $dossierRepository,EntityManagerInterface $entityManager)
    {
        $this->dossierRepository = $dossierRepository;
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/admin/dossier",name="app_admin_dossier")
     * @IsGranted("ROLE_SUPERUSER")
     */
    public function dossiers(){
        $dossiers = $this->dossierRepository->findAll();
        return $this->render("admin/dossier/dossier.html.twig",["dossiers"=>$dossiers]);
    }

    /**
     * @Route("/admin/dossier/new",name="app_admin_new_dossier")
     * @IsGranted("ROLE_SUPERUSER")
     */
    public function newdossier(Request $request){
        $form = $this->createForm(dossierFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /** @var  dossier $dossier */
            $dossier = $form->getData();
            $dossier->setDeleted(false);
            $this->entityManager->persist($dossier);
            $this->entityManager->flush();
            $this->addFlash("success","dossier ajouté");
            return $this->redirectToRoute("app_admin_dossier");

        }
        return $this->render("admin/dossier/dossierform.html.twig",["dossierForm"=>$form->createView()]);
    }

    /**
     * @Route("/admin/dossier/edit/{id}",name="app_admin_edit_dossier")
     * @IsGranted("ROLE_SUPERUSER")
     */
    public function editdossier(dossier $dossier,Request $request){
        $form = $this->createForm(DossierFormType::class,$dossier);
        $form->handleRequest($request);
        $rds = $dossier->getRoledossiers();
         $roles1=[];
         foreach ($rds as $rd){
             $roles1[] = $rd->getRoles();
             
 
         }
         //$roles1 = $Role->roleRepository->findAll();
         
         //$r = new Role();
         //$roles1[] = $r;
         //$form->get('role')->setData($roles1);
         if ($form->isSubmitted() && $form->isValid()){
             $roles = $form["role"]->getData();
             //var_dump($roles);
             //die();
             foreach ($roles as $role){
                 //commandes
                 if (!in_array($role, $roles1)){
 
                 $roleDossier = new Roledossier();
                 $roleDossier->setDossiers($dossier);
                 $roleDossier->setRoles($role);
                 $roleDossier->setLecture(false);
                 $roleDossier->setEcriture(false);
                 $roleDossier->setTelechargement(false);
                 $roleDossier->setAffichage(false);
                 $dossier->addRoledossier($roleDossier);
                }
             }
             foreach ($roles1 as $rl){
                 //commandes
                 if (!in_array($rl, $roles->toArray())){
 
                 $rdem = $this->entityManager->getRepository(Roledossier::class);
                 $rd = $rdem->findOneBy(["Roles"=>$rl->getId(),"Dossiers"=>$dossier->getId()]);
                 //var_dump($rd);
                 //die();
                 $dossier->removeRoledossier($rd);
                }
             }
             $dossier->setDeleted(false);
             $this->entityManager->persist($dossier);
            // $roleDossier->setdossier($dossier);
             //$this->entityManager->persist($roleDossier);
             $this->entityManager->flush();
             $this->addFlash("success","Dossier Modifié");
             return $this->redirectToRoute("app_admin_dossier");
         }
         else{
             $form->get('role')->setData($roles1);
         }
         
     
        return $this->render("admin/dossier/dossierform.html.twig",["dossierForm"=>$form->createView()]);
    }
/**
     * @Route("/admin/dossier/acces/{id}",name="app_admin_acces_dossier")
     * @IsGranted("ROLE_SUPERUSER")
     */
    public function addacces(dossier $dossier,Request $request){
        $form = $this->createForm(dossierFormType::class,$dossier);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $dossier->setValid(true)
                ->setDeleted(false);
            $this->entityManager->persist($dossier);
            $this->entityManager->flush();
            $this->addFlash("success","modifier ajouté");
            return $this->redirectToRoute("app_admin_dossier");
        }
        return $this->render("admin/dossier/dossierform.html.twig",["dossierForm"=>$form->createView()]);
    }
    /**
     * @Route("/admin/dossier/changevalidite/{id}",name="app_admin_changevalidite_dossier",methods={"post"})
     * @IsGranted("ROLE_WRITER")
     */
    public function activate(dossier $dossier){
        $dossier = $this->dossierRepository->changeValidite($dossier);
        return $this->json(["message"=>"success","value"=>$dossier->getValid()]);
    }

    /**
     * @Route("/admin/dossier/delete/{id}",name="app_admin_delete_dossier")
     * @IsGranted("ROLE_EDITORIAL")
     */
    public function delete(dossier $dossier){
        $dossier = $this->dossierRepository->delete($dossier);
        return $this->json(["message"=>"success","value"=>$dossier->getDeleted()]);
    }

    /**
     * @Route("/admin/dossier/groupaction",name="app_admin_groupaction_dossier")
     * @IsGranted("ROLE_WRITER")
     */
    public function groupAction(Request $request){
        $action = $request->get("action");
        $ids = $request->get("ids");
        $dossiers = $this->dossierRepository->findBy(["id"=>$ids]);
        if ($action=="desactiver" && $this->isGranted("dossier_EDITORIAL")){
            foreach ($dossiers as $dossier) {
                $dossier->setValid(false);
                $this->entityManager->persist($dossier);
            }
        }else if ($action=="activer" && $this->isGranted("dossier_EDITORIAL")){
            foreach ($dossiers as $dossier) {
                $dossier->setValid(true);
                $this->entityManager->persist($dossier);
            }
        }else if ($action=="supprimer" && $this->isGranted("dossier_EDITORIAL")){
            foreach ($dossiers as $dossier) {
                $dossier->setDeleted(true);
                $this->entityManager->persist($dossier);
            }
        }
        else{
            return $this->json(["message"=>"error"]);
        }
        $this->entityManager->flush();
        return $this->json(["message"=>"success","nb"=>count($dossiers)]);
    }

    //TODO: review dossier/access control for writers
    //TODO: Blog table add needed fields

}
