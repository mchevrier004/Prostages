<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/entreprises", name="prostagesEntreprises")
     */
    public function affEntreprises()
    {
        return $this->render('prostages/entreprises.html.twig', ['controller_name' => 'ProstagesController', ]);
    }
    /**
     * @Route("/formations", name="prostagesFormations")
     */
    public function affFormations()
    {
        echo "<h1>Cette page affichera la liste des formations de l'IUT</h1>";
        return $this->render('prostages/formations.html.twig', ['controller_name' => 'ProstagesController', ]);
    }
    /**
     * @Route("/stages/{etuID}", name="prostagesStages")
     */
    public function affStages($etuID)
    {
        echo "<h1>Cette page affichera le descriptif du stage ayant pour identifiant $etuID</h1>";
        return $this->render('prostages/stages.html.twig', ['controller_name' => 'ProstagesController', ]);
    }
}
