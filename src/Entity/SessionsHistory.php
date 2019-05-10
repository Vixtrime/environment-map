<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionsHistoryRepository")
 */
class SessionsHistory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="sessionsHistories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $session;

    /**
     * @ORM\Column(type="integer")
     */
    private $sensor_data;

    /**
     * @ORM\Column(type="array")
     */
    private $coordinates = [];


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sensor", inversedBy="sessionsHistories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sensor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): self
    {
        $this->session = $session;

        return $this;
    }

    public function getSensorData(): ?int
    {
        return $this->sensor_data;
    }

    public function setSensorData(int $sensor_data): self
    {
        $this->sensor_data = $sensor_data;

        return $this;
    }

    public function getCoordinates(): ?array
    {
        return $this->coordinates;
    }

    public function setCoordinates(array $coordinates): self
    {
        $this->coordinates = $coordinates;

        return $this;
    }


    public function getSensor(): ?Sensor
    {
        return $this->sensor;
    }

    public function setSensor(?Sensor $sensor): self
    {
        $this->sensor = $sensor;

        return $this;
    }
}
