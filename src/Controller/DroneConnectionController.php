<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DroneConnectionController extends AbstractController
{
    /**
     * @Route("/drone/connection", name="drone_connection")
     */
    public function index()
    {
        return $this->render('drone_connection/index.html.twig', [
            'controller_name' => 'DroneConnectionController',
        ]);
    }
}
