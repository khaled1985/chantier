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
                use App\Entity\Utilisateur;
                   use App\Entity\Pointages;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class PointagesController extends AbstractController
{
    /**
     * @Route("/pointages", name="app_pointages")
     */
    public function index(): Response
    {
        return $this->render('pointages/index.html.twig', [
            'controller_name' => 'PointagesController',
        ]);
    }




        /**
     * @Route("ajout_pointages",name="ajout_pointages")
     */

    public function ajout(Request $request,EntityManagerInterface $em){
                $pointages = new Pointages();
            $form = $this->createFormBuilder($pointages)
           /*    ->add('nom', TextType::class,[	'attr' => ['maxlength' => 20, 	'placeholder'=>'mat'   ]     ]) */
            ->add('utilisateur',EntityType::class, [
    // looks for choices from this entity
    'class' => Utilisateur::class,

    // uses the User.username property as the visible option string
    'choice_label' => 'Matricule',
    
     
])
               ->add('chantier',EntityType::class, [
    // looks for choices from this entity
    'class' => Chantiers::class,
 
     
    'choice_label' =>function ($chantier) {
        return $chantier->getNom() . ';' . $chantier->getDateDebut()->format('d/m/Y');
    },
    
])
              ->add('Date')
                     ->add('duree')

               
                ->getForm()  ;
      $form->handleRequest($request);  // Récupérer la request(les données de la requete)
 
                if($form->isSubmitted() && $form->isValid()){
                   
             
                 
                $pointages->setUtilisateur($form->getdata()->getutilisateur());
                  $pointages->setChantier($form->getdata()->getchantier());
                  
                //  $date=$form->getdata()->getchantier()->getDateDebut();
               

 					$em->persist($pointages);
                		$em->flush();

                      
                }
 

       return $this->render('pointages/add.html.twig', [

                'formchantiers' => $form->createView()
            ]);

    }


}
