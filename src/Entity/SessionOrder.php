<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionOrderRepository")
 */
class SessionOrder
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="sessionOrders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $session;

    /**
     * @ORM\Column(type="array")
     */
    private $coordinates = [];

    /**
     * @ORM\Column(type="boolean")
     */
    private $delivered;

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

    public function getCoordinates(): ?array
    {
        return $this->coordinates;
    }

    public function setCoordinates(array $coordinates): self
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    public function getDelivered(): ?bool
    {
        return $this->delivered;
    }

    public function setDelivered(bool $delivered): self
    {
        $this->delivered = $delivered;

        return $this;
    }
}
