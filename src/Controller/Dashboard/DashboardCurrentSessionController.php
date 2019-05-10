<?php

namespace App\Controller\Dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DashboardCurrentSessionController extends AbstractController
{
    /**
     * @Route("/dashboard/current/session", name="dashboard_current_session")
     */
    public function index()
    {
        return new JsonResponse('true');
    }
}
