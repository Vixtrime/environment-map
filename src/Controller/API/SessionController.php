<?php

namespace App\Controller\API;

use App\Services\API\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{

    /**
     * @Route("/api/v1/session/{action}/{id}", name="dashboard_session", defaults={"id" = 0})
     * @param $action
     * @param $id
     * @param Request $request
     * @param SessionService $sessionService
     * @return JsonResponse
     */
    public function sessionAction($action, $id, Request $request, SessionService $sessionService)
    {

        $response = null;

        switch ($action) {
            case 'create':
                $response = $sessionService->createSession(json_decode($request->getContent(), true));
                break;
            case 'get':
                $response = $sessionService->getSession($id, false);
                break;
            case 'get-active':
                $response = $sessionService->getSession($id, true);
                break;
            case 'close' :
                $response = $sessionService->closeSession($id);
        }

        return new JsonResponse($response);
    }
}
