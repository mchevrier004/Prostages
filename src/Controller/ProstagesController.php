<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;

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
        return $this->render('prostages/entreprises.html.twig', ['controller_name' => 'ProstagesController', ]);
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
    public function affFormEntreprises()
    {
        // Création d'une entreprise vierge
        $entreprise = new Entreprise();

        // Création d'un formulaire pour saisir les détails d'une entreprise
        $formulaireEntreprise = $this -> createFormBuilder($entreprise)
                                      -> add('nom')
                                      -> add('type')
                                      -> add('site')
                                      -> add('adresse')
                                      -> add('tel')
                                      -> getForm();
        // Les stages ne seront saisis qu'après la saisie des détails de l'entreprise

        // Générer la vue représentant le formulaire
        $vueFormEntreprise = $formulaireEntreprise -> createView();

        // Afficher le page d'ajout d'une entreprise
        return $this -> render('prostages/formAjoutEntreprise.html.twig',
                               ['vueFormEntreprise' => $vueFormEntreprise]);
    }
}
