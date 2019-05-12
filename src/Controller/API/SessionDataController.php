<?php

namespace App\Controller\API;

use App\Services\API\SessionDataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SessionDataController extends AbstractController
{
    /**
     * @Route("/api/v1/session-data/{action}/{id}", name="session-data", defaults={"id" = 0})
     * @param $action
     * @param $id
     * @param Request $request
     * @param SessionDataService $sessionDataService
     * @return JsonResponse
     */
    public function index($action, $id, Request $request, SessionDataService $sessionDataService)
    {
        $response = null;

        switch ($action) {
            case 'post' : $sessionDataService->postSessionData(json_decode($request->getContent(), true));
            break;
            case 'get' : $sessionDataService->getSessionData($id);
            break;
            case 'get-active' : $sessionDataService->getActiveSessionData($id);

        }

        return new JsonResponse($response);
    }
}
