<?php


namespace App\Services\API;


use App\Entity\Sensor;
use App\Entity\Session;
use App\Entity\SessionData;
use Doctrine\ORM\EntityManagerInterface;

class SessionDataService
{
    private $sessionDataRepository;
    private $sessionRepository;
    private $sensorRepository;
    private $em;
    private $test;

    /**
     * SessionDataService constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->sessionDataRepository = $this->em->getRepository(SessionData::class);
        $this->sessionRepository = $this->em->getRepository(Session::class);
        $this->sensorRepository = $this->em->getRepository(Sensor::class);
    }

    /**
     * @param $requestData
     * @return string
     */
    public function postSessionData($requestData)
    {

        $sensors = $this->sensorRepository->findAll();
        $activeSession = $this->sessionRepository->findOneBy(['status' => true]);

        foreach ($requestData as $dataset) {

            $coordinates = $dataset['coordinates'];

            foreach ($dataset['data'] as $sensor => $data) {

                $sessionDataField = new sessionData
                (
                    $data,
                    $coordinates,
                    $activeSession,
                    $this->getDesiredSensor($sensors, $sensor)
                );

                $this->em->persist($sessionDataField);
            }
        }

        $this->em->flush();
        return "Data was sent successfully";
    }

    /**
     * @param $id
     * @return SessionData[]|object[]
     */
    public function getSessionData($id)
    {
        return $this->sessionDataRepository->findBy(['id' => $id]);
    }

    /**
     * @param $sessId
     * @return array
     */
    public function getActiveSessionData($sessId)
    {
        $datasetArray = [];
        $currentSessionData = $this->sessionDataRepository->findBy(['session' => $sessId]);

        foreach ($currentSessionData as $sessionDataField) {

            $coordinates = $sessionDataField->getCoordinates();
            $sensor = $sessionDataField->getSensor()->getName();
            $key = $this->getCoordinateIfExist($datasetArray, $sessionDataField->getCoordinates());
            if ($key === 'not exist') {
                $datasetArray[] =
                    [
                        'coordinates' => $coordinates,
                        'data' => [$sensor => $sessionDataField->getSensorData()]
                    ];
            } else {
                $datasetArray[$key]['data'][$sensor] = $sessionDataField->getSensorData();
            }
        }
        return $datasetArray;
    }

    /**
     * @param $datasetArray
     * @param $searchCoordinates
     * @return int|string
     */
    private function getCoordinateIfExist($datasetArray, $searchCoordinates)
    {
        foreach ($datasetArray as $datasetKey => $datasetData) {

            if ($datasetData['coordinates'] && $datasetData['coordinates'] == $searchCoordinates) {
                return $datasetKey;
            }
        }
        return 'not exist';
    }

    /**
     * @param $sensors
     * @param $desiredSensor
     * @return mixed|null
     */
    private function getDesiredSensor($sensors, $desiredSensor)
    {

        foreach ($sensors as $sensor) {
            if ($sensor->getName() == $desiredSensor) {
                return $sensor;
            }
        }
        return null;
    }
}
