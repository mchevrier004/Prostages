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
    public function afficherEntreprises()
    {
        return $this->render('prostages/entreprises.html.twig', ['controller_name' => 'ProstagesController', ]);
    }
    /**
     * @Route("/formations", name="prostagesFormations")
     */
    public function afficherFormations()
    {
        return $this->render('prostages/formations.html.twig', ['controller_name' => 'ProstagesController', ]);
    }
}
