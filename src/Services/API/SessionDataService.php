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

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->sessionDataRepository = $this->em->getRepository(SessionData::class);
        $this->sessionRepository = $this->em->getRepository(Session::class);
        $this->sensorRepository = $this->em->getRepository(Sensor::class);
    }


    public function postSessionData($requestData)
    {
        dump($requestData);
        $sensors = $this->sensorRepository->findAll();
        $activeSession = $this->sessionRepository->findOneBy(['status' => true]);

        foreach ($requestData as $dataField) {

            foreach ($dataField as $sensor => $sensorData) {

                $sessionData = new sessionData;
                $sessionData->setSensor($this->getDesiredSensor($sensors, $sensor));
                $sessionData->setSession($activeSession);

                foreach ($sensorData as $sensorData => $coordinates) {
                    $sessionData->setSensorData($sensorData);
                    $sessionData->setCoordinates($coordinates);
                }

                $this->em->persist($sessionData);
            }
        }

        $this->em->flush();
        return "Data was sent successfully";
    }


    private function getDesiredSensor($sensors, $desiredSensor)
    {

        foreach ($sensors as $sensor) {
            if ($sensor->getName() == $desiredSensor) {
                return $sensor;
            }
        }
        return null;
    }


    public function getSessionData($id)
    {
        return $this->sessionDataRepository->findBy(['id' => $id]);
    }


    public function getActiveSessionData($sessId)
    {
        $dataSet = [];
        $currentSessionData = $this->sessionDataRepository->findBy(['session' => $sessId]);

        foreach ($currentSessionData as $sessionDataField) {

            $pointSensor = $sessionDataField->getSensor()->getName();
            $sensorData = [$sessionDataField->getSensorData() => $sessionDataField->getCoordinates()];

            $key = $this->getCoordinateIfExist($dataSet, $sessionDataField->getCoordinates());

            if ($key === 'not exist') {
                $dataSet[] = [$pointSensor => $sensorData];
            } else {
                $dataSet[$key][$pointSensor] = $sensorData;
            }
        }

        return $dataSet;
    }


    private function getCoordinateIfExist($dataSet, $searchCoordinates)
    {
        foreach ($dataSet as $dataSetKey => $dataSetValue) {

            if ($this->isCoordinatesExist($dataSetValue, $searchCoordinates)) {
                return $dataSetKey;
            }
        }
        return 'not exist';
    }


    private function isCoordinatesExist($array, $searchCoordinates)
    {
        foreach ($array as $sensorData) {
            if ($searchCoordinates == $sensorData) {
                return true;
            } else if (is_array($sensorData)) {
                if ($this->isCoordinatesExist($sensorData, $searchCoordinates)) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
}
