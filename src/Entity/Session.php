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
     * @ORM\OneToMany(targetEntity="App\Entity\SessionsHistory", mappedBy="session")
     */
    private $sessionsHistories;

    public function __construct()
    {
        $this->sessionOrders = new ArrayCollection();
        $this->sessionsHistories = new ArrayCollection();
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
            $sessionsHistory->setSession($this);
        }

        return $this;
    }

    public function removeSessionsHistory(SessionsHistory $sessionsHistory): self
    {
        if ($this->sessionsHistories->contains($sessionsHistory)) {
            $this->sessionsHistories->removeElement($sessionsHistory);
            // set the owning side to null (unless already changed)
            if ($sessionsHistory->getSession() === $this) {
                $sessionsHistory->setSession(null);
            }
        }

        return $this;
    }
}
