<?php

namespace App\Controller\API;

use App\Services\API\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{

    /**
     * @Route("/api/v1/session/{action}/{id}", name="dashboard_session", defaults={"id" = 0})
     */
    public function sessionAction($action, $id, Request $request, SessionService $sessionService)
    {

        $response = null;

        switch ($action) {
            case 'create':
                $response = $sessionService->createSession(json_decode($request->getContent(), true));
                break;
            case 'get':
                $response = $sessionService->createSession($id);
                break;
            case 'close' :
                $response = $sessionService->closeSession($id);
        }

        return $response;
    }
}
