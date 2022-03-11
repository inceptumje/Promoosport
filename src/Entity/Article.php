<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please enter a title.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The title is too short.",
     *     maxMessage="The title is too long.",
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="blob")
     * @Assert\NotBlank(message="Please enter a content.")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbViews = 0 ;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNbViews(): ?int
    {
        return $this->nbViews;
    }

    public function setNbViews(int $nbViews): self
    {
        $this->nbViews = $nbViews;

        return $this;
    }



    public function incrementNbViews()
    {
        $this->nbViews++;
    }

}
