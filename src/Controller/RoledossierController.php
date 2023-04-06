<?php


namespace App\Controller;


use App\Entity\Roledossier;
use App\Form\RoledossierFormType;
use App\Repository\RoledossierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RoledossierController extends BaseController
{

    private $roleDossierRepository;
    private $entityManager;

    public function __construct(RoledossierRepository $roleDossierRepository,EntityManagerInterface $entityManager)
    {
        $this->roleDossierRepository = $roleDossierRepository;
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/admin/roledossier/edit/{id}",name="app_admin_edit_droitacces")
     * @IsGranted("ROLE_SUPERUSER")
     */
    public function editRole(Roledossier $roledossier,Request $request){
        $rolesdossier = $this->roleDossierRepository->findAll();
        return $this->render("admin/dossier/roledossier.html.twig",["rolesdossier"=>$rolesdossier]);
    }
       

    /**
     * @Route("/admin/roledossier/edit/{id}",name="app_admin_edit_droitacces")
     * @IsGranted("ROLE_SUPERUSER")
     */
    /*public function editRole(Roledossier $roledossier,Request $request)
    {
        $form = $this->createForm(RoledossierFormType::class,$roledossier);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $role->setValid(true)
                ->setDeleted(false);
            $this->entityManager->persist($roledossier);
            $this->entityManager->flush();
            $this->addFlash("success","MAJ Role Dossier avec succès");
            return $this->redirectToRoute("app_admin_role");
        }
        return $this->render("admin/dossier/roleform.html.twig",["roledossierForm"=>$form->createView()]);
    }
*/
   

    

}
