<?php


namespace App\Controller;


use App\Entity\Role;
use App\Form\RoleFormType;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RoleController extends BaseController
{

    private $roleRepository;
        private $entityManager;

    public function __construct(RoleRepository $roleRepository,EntityManagerInterface $entityManager)
    {
        $this->roleRepository = $roleRepository;
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/admin/role",name="app_admin_role")
     * @IsGranted("ROLE_SUPERUSER")
     */
    public function roles(){
        $roles = $this->roleRepository->findAll();
        return $this->render("admin/role/role.html.twig",["roles"=>$roles]);
    }

    /**
     * @Route("/admin/role/new",name="app_admin_new_role")
     * @IsGranted("ROLE_SUPERUSER")
     */
    public function newRole(Request $request){
        $form = $this->createForm(RoleFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /** @var  Role $role */
            $role = $form->getData();
            $role->setValid(true)
                ->setDeleted(false);
            $this->entityManager->persist($role);
            $this->entityManager->flush();
            $this->addFlash("success","Role ajouté");
            return $this->redirectToRoute("app_admin_role");

        }
        return $this->render("admin/role/roleform.html.twig",["roleForm"=>$form->createView()]);
    }

    /**
     * @Route("/admin/role/edit/{id}",name="app_admin_edit_role")
     * @IsGranted("ROLE_SUPERUSER")
     */
    public function editRole(Role $role,Request $request){
        $form = $this->createForm(RoleFormType::class,$role);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $role->setValid(true)
                ->setDeleted(false);
            $this->entityManager->persist($role);
            $this->entityManager->flush();
            $this->addFlash("success","Role ajouté");
            return $this->redirectToRoute("app_admin_role");
        }
        return $this->render("admin/role/roleform.html.twig",["roleForm"=>$form->createView()]);
    }

    /**
     * @Route("/admin/role/changevalidite/{id}",name="app_admin_changevalidite_role",methods={"post"})
     * @IsGranted("ROLE_WRITER")
     */
    public function activate(Role $role){
        $role = $this->roleRepository->changeValidite($role);
        return $this->json(["message"=>"success","value"=>$role->getValid()]);
    }

    /**
     * @Route("/admin/role/delete/{id}",name="app_admin_delete_role")
     * @IsGranted("ROLE_EDITORIAL")
     */
    public function delete(Role $role){
        $role = $this->roleRepository->delete($role);
        return $this->json(["message"=>"success","value"=>$role->getDeleted()]);
    }

    /**
     * @Route("/admin/role/groupaction",name="app_admin_groupaction_role")
     * @IsGranted("ROLE_WRITER")
     */
    public function groupAction(Request $request){
        $action = $request->get("action");
        $ids = $request->get("ids");
        $roles = $this->roleRepository->findBy(["id"=>$ids]);
        if ($action=="desactiver" && $this->isGranted("ROLE_EDITORIAL")){
            foreach ($roles as $role) {
                $role->setValid(false);
                $this->entityManager->persist($role);
            }
        }else if ($action=="activer" && $this->isGranted("ROLE_EDITORIAL")){
            foreach ($roles as $role) {
                $role->setValid(true);
                $this->entityManager->persist($role);
            }
        }else if ($action=="supprimer" && $this->isGranted("ROLE_EDITORIAL")){
            foreach ($roles as $role) {
                $role->setDeleted(true);
                $this->entityManager->persist($role);
            }
        }
        else{
            return $this->json(["message"=>"error"]);
        }
        $this->entityManager->flush();
        return $this->json(["message"=>"success","nb"=>count($roles)]);
    }

    //TODO: review role/access control for writers
    //TODO: Blog table add needed fields

}
