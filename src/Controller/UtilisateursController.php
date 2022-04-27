<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\paginate;
 use App\Repository\UtilisateurRepository;
  use Doctrine\ORM\EntityManagerInterface;
      use Symfony\Component\HttpFoundation\Request;
        use App\Entity\Utilisateur;
class UtilisateursController extends AbstractController
{
    /**
     * @Route("/", name="")
     */
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }



    /**
     * @Route("crud",name="crud")
     */

    public function pagination(Request $request,UtilisateurRepository $repo,PaginatorInterface $paginator,EntityManagerInterface $em){
      $query = $repo->findAll();
         $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
           8 /*limit per page*/
        );

      return $this->render('utilisateurs/listes.html.twig',[
    "properties"=>$pagination
      ]) ;


    }





    /**
     * @Route("delete_etudiant/{id}",name="delete_etudiant")
     */

    public function delete_etudiant($id,UtilisateurRepository $repo,EntityManagerInterface $em){

        $etudiant = $repo->find($id);

            if ( !$etudiant)
            {
                throw $this->createNotFoundException("L'etudiant d'id " .$id.  " n'existe pas.");

            }

            $em->remove($etudiant);
            $em->flush();
            $this->addFlash('danger', 'etudiant '.$id.'  a bien étais supprimer');
        return $this->redirectToRoute('crud');
    }


    /**
     * @Route("update_etudiant/{id}",name="update_etudiant")
     */

    public function update_etudiant($id,Request $request,UtilisateurRepository $repo,EntityManagerInterface $em){

        $etudiant = $repo->findOneById($id);
        $form = $this->createFormBuilder($etudiant)
           /*    ->add('nom', TextType::class,[	'attr' => ['maxlength' => 20, 	'placeholder'=>'mat'   ]     ]) */
            ->add('nom')
                  ->add('prenom')
                ->add('matricule')
              
                ->getForm()  ;

          $form->handleRequest($request);  // Récupérer la request(les données de la requete)


                if($form->isSubmitted() && $form->isValid()){





                    $em->persist($etudiant);
                    $em->flush();
                     return $this->redirectToRoute('crud');
                }
                   return $this->render('utilisateurs/update.html.twig', [
                'formEtudiant' => $form->createView()
            ]);
    }






        /**
     * @Route("ajout",name="ajout")
     */

    public function ajout(Request $request,EntityManagerInterface $em){
                $utilisateur = new Utilisateur();
            $form = $this->createFormBuilder($utilisateur)
           /*    ->add('nom', TextType::class,[	'attr' => ['maxlength' => 20, 	'placeholder'=>'mat'   ]     ]) */
            ->add('nom')
                  ->add('prenom')
                ->add('matricule')
               
                ->getForm()  ;
      $form->handleRequest($request);  // Récupérer la request(les données de la requete)

                if($form->isSubmitted() && $form->isValid()){
                   
                		$em->persist($utilisateur);
                		$em->flush();
 					

                     return $this->redirectToRoute('crud');
                }
 

       return $this->render('utilisateurs/add.html.twig', [

                'formUtilisateur' => $form->createView()
            ]);

    }



}
