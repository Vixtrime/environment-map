<?php


namespace App\Services\API;


use App\Entity\Session;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class SessionService
{

    private $sessionRepository;
    private $em;
    private $serializer;


    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
        $this->sessionRepository = $this->em->getRepository(Session::class);
    }


    public function createSession($requestData)
    {
        $openedSession = $this->sessionRepository->findBy(['status' => true]);

        if ($openedSession) {
            $message = 'You have an opened session - ' . $openedSession[0]->getName() . '. Please, close session before starting new.';
            return new JsonResponse($message);
        }

        $newSession = new Session($requestData['name'], $requestData['description'], true);

        $this->em->persist($newSession);
        $this->em->flush($newSession);

        $currentSession = $this->sessionRepository->findOneBy(['status' => true]);

        $response['message'] = 'New session was started successfully';
        $response['sessionName'] = $currentSession->getName();
        $response['sessionId'] = $currentSession->getId();
        $response['sessionDescription'] = $currentSession->getDescription();
        $response['sessionStatus'] = $currentSession->getStatus();

        return new JsonResponse($response);
    }


    public function getSession($id)
    {
        $session = $this->sessionRepository->findOneBy(['id' => $id]);

        $response['sessionName'] = $session->getName();
        $response['sessionId'] = $session->getId();
        $response['sessionDescription'] = $session->getDescription();
        $response['sessionStatus'] = $session->getStatus();

        return new JsonResponse($response);
    }


    public function closeSession($id)
    {
        $session = $this->sessionRepository->findOneBy(['id' => $id]);
        $session->setStatus(false);

        $this->em->persist($session);
        $this->em->flush($session);

        return new JsonResponse(['message' => 'Session was closed successfully']);
    }

}
