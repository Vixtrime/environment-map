<?php

namespace App\Controller\Dashboard;

use App\Entity\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardSessionController extends AbstractController
{
    /**
     * @Route("/dashboard/session/{action}", name="dashboard_session", methods={"POST"})
     */
    public function sessionAction($action, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestData = json_decode($request->getContent(), true);
        $message = null;
        if ($action == 'new') {
            $openedSession = $this->getDoctrine()->getRepository(Session::class)->findBy(['status' => true]);
            if ($openedSession) {
                $message = 'You have an opened session - ' . $openedSession[0]->getName() . '. Please, close session before starting new.';
                return new JsonResponse($message);
            }
            $newSession = new Session();
            $newSession->setStatus(true);
            $newSession->setName($requestData['name']);
            $newSession->setDescription($requestData['description']);
            $em->persist($newSession);
            $message = 'New session was started successfully';
            $em->flush();
            return new JsonResponse($message);
        }

        if ($action == 'close') {
            $openedSession = $this->getDoctrine()->getRepository(Session::class)->findBy(['status' => true]);
            foreach ($openedSession as $session) {
                $session->setStatus(false);
                $em->persist($session);
            }
            $em->flush();
            return new JsonResponse('Session was closed successfully');
        }

        return new JsonResponse();
    }


    /**
     * @Route("/dashboard/session/{action}", name="daschboard-session-get", methods={"GET"})
     */
    public function getSessionAction($action){

        if($action == 'get'){
            return new JsonResponse('getAction');
        }

        return new JsonResponse('something wrong');
    }

}
