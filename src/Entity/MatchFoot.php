<?php

namespace App\Entity;

use App\Repository\MatchFootRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatchFootRepository::class)
 */
class MatchFoot
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $host;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $guest;

    /**
     * @ORM\ManyToOne(targetEntity=League::class, inversedBy="matches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $league;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHost(): ?Team
    {
        return $this->host;
    }

    public function setHost(?Team $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function getGuest(): ?Team
    {
        return $this->guest;
    }

    public function setGuest(?Team $guest): self
    {
        $this->guest = $guest;

        return $this;
    }

    public function getLeague(): ?League
    {
        return $this->league;
    }

    public function setLeague(?League $league): self
    {
        $this->league = $league;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}