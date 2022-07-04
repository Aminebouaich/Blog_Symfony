<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NomDuControleurController extends AbstractController
{
    #[Route('/nom/du/controleur', name: 'app_nom_du_controleur')]
    public function index(): Response
    {
        return $this->render('nom_du_controleur/index.html.twig', [
            'controller_name' => 'NomDuControleurController',
        ]);
    }
}
