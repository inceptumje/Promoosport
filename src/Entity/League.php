<?php

namespace App\Entity;

use App\Repository\LeagueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=LeagueRepository::class)
 */
class League
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logo;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     * @var File
     */
    private $logoFile;


    /**
     * @ORM\OneToMany(targetEntity=MatchFoot::class, mappedBy="league", orphanRemoval=true)
     */
    private $matches;

    public function __construct()
    {
        $this->matches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection<int, MatchFoot>
     */
    public function getMatches(): Collection
    {
        return $this->matches;
    }

    public function addMatch(MatchFoot $match): self
    {
        if (!$this->matches->contains($match)) {
            $this->matches[] = $match;
            $match->setLeague($this);
        }

        return $this;
    }

    public function removeMatch(MatchFoot $match): self
    {
        if ($this->matches->removeElement($match)) {
            // set the owning side to null (unless already changed)
            if ($match->getLeague() === $this) {
                $match->setLeague(null);
            }
        }

        return $this;
    }
}
