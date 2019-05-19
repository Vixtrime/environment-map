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


    /**
     * SessionService constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->sessionRepository = $this->em->getRepository(Session::class);
    }


    /**
     * @param $requestData
     * @return JsonResponse
     */
    public function createSession($requestData)
    {
        $openedSession = $this->sessionRepository->findBy(['status' => true]);

        if ($openedSession) {
            $message = 'You have an opened session - ' . $openedSession[0]->getName() . '. Please, close active session before starting new.';
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

        return $response;
    }


    /**
     * @param $id
     * @param $active
     * @return mixed
     */
    public function getSession($id, $active)
    {
        $active ? $session = $this->sessionRepository->findOneBy(['status' => true]) :
            $session = $this->sessionRepository->findOneBy(['id' => $id]);

        $response = null;

        if($session){
            $response['sessionName'] = $session->getName();
            $response['sessionId'] = $session->getId();
            $response['sessionDescription'] = $session->getDescription();
            $response['sessionStatus'] = $session->getStatus();
        } else {
            null;
        }


        return $response;
    }

    /**
     * @param $id
     * @return array
     */
    public function closeSession($id)
    {
        $session = $this->sessionRepository->findOneBy(['id' => $id]);
        $session->setStatus(false);

        $this->em->persist($session);
        $this->em->flush($session);

        return ['message' => 'Session was closed successfully'];
    }
}
