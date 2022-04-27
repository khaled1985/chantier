<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\paginate;
 use App\Repository\ChantiersRepository;
  use Doctrine\ORM\EntityManagerInterface;
      use Symfony\Component\HttpFoundation\Request;
        use App\Entity\Chantiers;

class ChantiersController extends AbstractController
{
    /**
     * @Route("/chantiers", name="app_chantiers")
     */
    public function index(): Response
    {
        return $this->render('chantiers/index.html.twig', [
            'controller_name' => 'ChantiersController',
        ]);
    }




    /**
     * @Route("crud_chantiers",name="crud_chantiers")
     */

    public function pagination(Request $request,ChantiersRepository $repo,PaginatorInterface $paginator,EntityManagerInterface $em){
      $query = $repo->findAll();
         $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
           8 /*limit per page*/
        );

      return $this->render('chantiers/listes.html.twig',[
    "properties"=>$pagination
      ]) ;


    }





        /**
     * @Route("ajout_chantier",name="ajout_chantier")
     */

    public function ajout(Request $request,EntityManagerInterface $em){
                $Chantiers = new Chantiers();
            $form = $this->createFormBuilder($Chantiers)
           /*    ->add('nom', TextType::class,[	'attr' => ['maxlength' => 20, 	'placeholder'=>'mat'   ]     ]) */
            ->add('nom')
                  ->add('adresse')
                ->add('DateDebut')
               
                ->getForm()  ;
      $form->handleRequest($request);  // Récupérer la request(les données de la requete)

                if($form->isSubmitted() && $form->isValid()){
                   
                		$em->persist($Chantiers);
                		$em->flush();
 					

                     return $this->redirectToRoute('crud_chantiers');
                }
 

       return $this->render('chantiers/add.html.twig', [

                'formchantiers' => $form->createView()
            ]);

    }






    /**
     * @Route("delete_chantier/{id}",name="delete_chantier")
     */

    public function delete_chantier($id,ChantiersRepository $repo,EntityManagerInterface $em){

        $chantier = $repo->find($id);

            if ( !$chantier)
            {
                throw $this->createNotFoundException("L'chantier d'id " .$id.  " n'existe pas.");

            }

            $em->remove($chantier);
            $em->flush();
            $this->addFlash('danger', 'chantier '.$id.'  a bien étais supprimer');
        return $this->redirectToRoute('crud_chantiers');
    }


    /**
     * @Route("update_chantier/{id}",name="update_chantier")
     */

    public function update_chantier($id,Request $request,ChantiersRepository $repo,EntityManagerInterface $em){

        $chantier = $repo->findOneById($id);
        $form = $this->createFormBuilder($chantier)
           /*    ->add('nom', TextType::class,[	'attr' => ['maxlength' => 20, 	'placeholder'=>'mat'   ]     ]) */
            ->add('nom')
                  ->add('adresse')
                ->add('DateDebut')
              
                ->getForm()  ;

          $form->handleRequest($request);  // Récupérer la request(les données de la requete)


                if($form->isSubmitted() && $form->isValid()){





                    $em->persist($chantier);
                    $em->flush();
                     return $this->redirectToRoute('crud_chantiers');
                }
                   return $this->render('chantiers/update.html.twig', [
                'formChantier' => $form->createView()
            ]);
    }






}
