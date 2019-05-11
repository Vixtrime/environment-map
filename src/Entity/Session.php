<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 */
class Session
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
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SessionOrder", mappedBy="session")
     */
    private $sessionOrders;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SessionData", mappedBy="session")
     */
    private $sessionData;

    public function __construct($name, $description, $status)
    {
        $this->setName($name);
        $this->setDescription($description);
        $this->setStatus($status);
        $this->sessionOrders = new ArrayCollection();
        $this->sessionData = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|SessionOrder[]
     */
    public function getSessionOrders(): Collection
    {
        return $this->sessionOrders;
    }

    public function addSessionOrder(SessionOrder $sessionOrder): self
    {
        if (!$this->sessionOrders->contains($sessionOrder)) {
            $this->sessionOrders[] = $sessionOrder;
            $sessionOrder->setSession($this);
        }

        return $this;
    }

    public function removeSessionOrder(SessionOrder $sessionOrder): self
    {
        if ($this->sessionOrders->contains($sessionOrder)) {
            $this->sessionOrders->removeElement($sessionOrder);
            // set the owning side to null (unless already changed)
            if ($sessionOrder->getSession() === $this) {
                $sessionOrder->setSession(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

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
            $sessionData->setSession($this);
        }

        return $this;
    }

    public function removeSessionData(SessionData $sessionData): self
    {
        if ($this->sessionData->contains($sessionData)) {
            $this->sessionData->removeElement($sessionData);
            // set the owning side to null (unless already changed)
            if ($sessionData->getSession() === $this) {
                $sessionData->setSession(null);
            }
        }

        return $this;
    }
}
