<?php

namespace App\Entity;

use App\Repository\PromosportRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PromosportRepository::class)
 */
class Promosport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="blob")
     * @Assert\NotBlank(message="Please enter a content.")
     */
    private $content;


    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getContent()
    {
        if($this->content) {
            rewind($this->content);
            return stream_get_contents($this->content);
        }
        return null;
    }

    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }



    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }


}
