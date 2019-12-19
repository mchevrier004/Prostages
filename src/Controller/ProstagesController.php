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
    public function affStages()
    {
        return $this->render('prostages/stages.html.twig', ['controller_name' => 'ProstagesController', 'idEtu' => $_POST['idEtu']]);
    }
    /**
     * @Route("/prostages/stages", name="prostagesSelecEtu")
     */
    public function affSelectStagesEtu()
    {
        return $this->render('prostages/selectStagesEtu.html.twig',['controller_name' => 'ProstagesController']);
    }
}
