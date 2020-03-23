<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use App\Entity\OffreStage;
use App\Entity\Formation;
use App\Form\EntrepriseType;
use App\Form\OffreStageType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\Common\Persistence\ObjectManager;

class ProstagesController extends AbstractController
{
    /**
     * @Route("/", name="prostagesAccueil")
     */
    public function index()
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'ProstagesController',
        ]);
    }
    /**
     * @Route("/entreprises", name="prostagesEntreprises")
     */
    public function affEntreprises()
    {
        $listeEntreprises = $this->getDoctrine()->getRepository(Entreprise::class)->findAll();

        return $this->render('entreprises.html.twig', ['controller_name' => 'ProstagesController', 
                                                                 'listeEntreprises' => $listeEntreprises]);
    }
    /**
     * @Route("/formations", name="prostagesFormations")
     */
    public function affFormations()
    {
        $listeFormations = $this->getDoctrine()->getRepository(Formation::class)->findByNomASC();

        return $this->render('formations.html.twig', ['controller_name' => 'ProstagesController',
                                                                'listeFormations' => $listeFormations]);
    }
    /**
     * @Route("/stages/{idEtu}", name="prostagesStages")
     */
    public function affStages($idEtu)
    {
        //Récupération des stages et des formations
        $listeStages = $this->getDoctrine()->getRepository(OffreStage::class)->findAll();
        $listeFormations = $this->getDoctrine()->getRepository(Formation::class)->findAll();

        //Envoi des informations à la vue
        return $this->render('stages.html.twig', ['controller_name' => 'ProstagesController', 'idEtu' => $idEtu,
                                                            'listeStages' => $listeStages,
                                                            'listeFormations' => $listeFormations]);
    }
    /**
     * @Route("/entreprises/ajouter", name="prostagesEntreprisesForm")
     */
    public function affFormEntreprises(Request $requeteHttp, ObjectManager $manager)
    {
        // Création d'une entreprise vierge
        $entreprise = new Entreprise();

        // Création d'un formulaire pour saisir les détails d'une entreprise
        $formulaireEntreprise = $this -> createForm(EntrepriseType::class, $entreprise);
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
    /**
     * @Route("/prostages/stage-ajout", name="prostagesStageForm")
     */
    public function affFormStages(Request $requeteHttp, ObjectManager $manager){
        $stage = new OffreStage();
        $formStage = $this -> createForm(OffreStageType::class, $stage);
        $formStage -> handleRequest($requeteHttp);
        if($formStage -> isSubmitted() && $formStage -> isValid()){
            $manager -> persist($stage);
            $manager -> flush();
            return $this -> redirectToRoute('prostagesStages');
        }
        $vueFormStage = $formStage -> createView();
        return $this -> render('prostages/formAjoutStage.html.twig',
                                ['vueFormStage' => $vueFormStage]);
    }
}
