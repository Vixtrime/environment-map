<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SensorRepository")
 */
class Sensor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $unit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SessionData", mappedBy="sensor")
     */
    private $sessionData;


    public function __construct()
    {
        $this->sessionData = new ArrayCollection();
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * @return Collection|SessionData[]
     */
    public function getSessionData(): Collection
    {
        return $this->sessionData;
    }

    public function addSessionData(SessionData $sessionData): self
    {
        if (!$this->sessionData->contains($sessionData)) {
            $this->sessionData[] = $sessionData;
            $sessionData->setSensor($this);
        }

        return $this;
    }

    public function removeSessionData(SessionData $sessionData): self
    {
        if ($this->sessionData->contains($sessionData)) {
            $this->sessionData->removeElement($sessionData);
            // set the owning side to null (unless already changed)
            if ($sessionData->getSensor() === $this) {
                $sessionData->setSensor(null);
            }
        }

        return $this;
    }

}
