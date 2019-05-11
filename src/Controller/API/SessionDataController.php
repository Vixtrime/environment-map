<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SessionDataController extends AbstractController
{
    /**
     * @Route("/session/data", name="session_data")
     */
    public function index()
    {
        return new JsonResponse('true');
    }
}
