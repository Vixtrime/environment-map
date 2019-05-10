<?php

namespace App\Controller\Dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DashboardSessionsHistoryController extends AbstractController
{
    /**
     * @Route("/dashboard/sessions/history", name="dashboard_sessions_history")
     */
    public function index()
    {
        return new JsonResponse('true');
    }
}
