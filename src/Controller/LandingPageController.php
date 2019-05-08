<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class LandingPageController extends AbstractController
{
    /**
     * @Route("/landing", name="landing_page")
     */
    public function index()
    {


        return $this->render('landing_page/index.html.twig', [
            'controller_name' => 'LandingPageController',
            'view' => ['test']
        ]);
    }
}
