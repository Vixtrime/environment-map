<?php

namespace App\Controller\Dashboard;

use App\Services\Dashboard\UrlGenerateService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DashboardMainController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard_main")
     * @Route("/", name="default")
     * @param Request $request
     * @param UrlGenerateService $urlGenerateService
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, UrlGenerateService $urlGenerateService)
    {
        $urls = $urlGenerateService->GenerateUrlArray();

        if ($request->attributes->get('_route') == 'default') {
            return $this->redirectToRoute('dashboard_main');
        }

        return $this->render('dashboard_main/index.html.twig', [
            "urlArray" => $urls,
        ]);
    }
}
