<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class ProstagesController extends AbstractController
{
    /**
     * @Route("/prostages", name="prostagesAccueil")
     */
    public function index()
    {
        return $this->render('prostages/index.html.twig', [
            'controller_name' => 'ProstagesController',
        ]);
    }
    /**
     * @Route("/prostages/entreprises", name="prostagesEntreprises")
     */
    public function affEntreprises()
    {
        $listeEntreprises = $this->getDoctrine()->getRepository(Entreprise::class)->findAll();

        return $this->render('prostages/entreprises.html.twig', ['controller_name' => 'ProstagesController', 
                                                                 'listeEntreprises' => $listeEntreprises]);
    }
    /**
     * @Route("/prostages/formations", name="prostagesFormations")
     */
    public function affFormations()
    {
        return $this->render('prostages/formations.html.twig', ['controller_name' => 'ProstagesController', ]);
    }
    /**
     * @Route("/prostages/stages/{idEtu}", name="prostagesStages")
     */
    public function affStages($idEtu)
    {
        return $this->render('prostages/stages.html.twig', ['controller_name' => 'ProstagesController', 'idEtu' => $idEtu]);
    }
    /**
     * @Route("/prostages/entreprises/ajouter", name="prostagesEntreprisesForm")
     */
    public function affFormEntreprises(Request $requeteHttp)
    {
        // Création d'une entreprise vierge
        $entreprise = new Entreprise();

        // Création d'un formulaire pour saisir les détails d'une entreprise
        $formulaireEntreprise = $this -> createFormBuilder($entreprise)
                                      -> add('nom')
                                      -> add('type')
                                      -> add('site',UrlType::class)
                                      -> add('adresse')
                                      -> add('tel',TelType::class)
                                      -> getForm();
        // Les stages ne seront saisis qu'après la saisie des détails de l'entreprise

        $formulaireEntreprise -> handleRequest($requeteHttp);

        // Vérification des saisies, soumission du formulaire
        if($formulaireEntreprise -> isSubmitted()  && $formulaireEntreprise -> isValid()){

            // Enregistrement de l'entreprise en BD
            $manager->persist($entreprise);
            $manager->flush();

            // Redirection de l'utilisateur vers la liste des entreprises
            return $this -> redirectToRoute('prostagesEntreprises');
        }

        // Générer la vue représentant le formulaire
        $vueFormEntreprise = $formulaireEntreprise -> createView();

        // Afficher le page d'ajout d'une entreprise
        return $this -> render('prostages/formAjoutEntreprise.html.twig',
                               ['vueFormEntreprise' => $vueFormEntreprise]);
    }
}
