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
     * @ORM\OneToMany(targetEntity="App\Entity\SessionsHistory", mappedBy="sensor")
     */
    private $sessionsHistories;

    public function __construct()
    {
        $this->sessionsHistories = new ArrayCollection();
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
     * @return Collection|SessionsHistory[]
     */
    public function getSessionsHistories(): Collection
    {
        return $this->sessionsHistories;
    }

    public function addSessionsHistory(SessionsHistory $sessionsHistory): self
    {
        if (!$this->sessionsHistories->contains($sessionsHistory)) {
            $this->sessionsHistories[] = $sessionsHistory;
            $sessionsHistory->setSensor($this);
        }

        return $this;
    }

    public function removeSessionsHistory(SessionsHistory $sessionsHistory): self
    {
        if ($this->sessionsHistories->contains($sessionsHistory)) {
            $this->sessionsHistories->removeElement($sessionsHistory);
            // set the owning side to null (unless already changed)
            if ($sessionsHistory->getSensor() === $this) {
                $sessionsHistory->setSensor(null);
            }
        }

        return $this;
    }
}
