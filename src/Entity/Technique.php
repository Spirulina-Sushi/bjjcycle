<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TechniqueRepository")
 */
class Technique
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $name;

    

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Catagory")
     * @ORM\JoinColumn(nullable=false)
     */
    private $catagory;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cycle", inversedBy="techniques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cycle;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Position", inversedBy="techniquesStart")
     * @ORM\JoinTable(name="start_technique_position")
     */
    private $startPosition;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Position", inversedBy="techniquesEnd")
     * @ORM\JoinTable(name="end_technique_position")
     */
    private $endPosition;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Video", mappedBy="technique")
     */
    private $videos;

    public function __construct()
    {
        $this->video = new ArrayCollection();
        $this->startPosition = new ArrayCollection();
        $this->endPosition = new ArrayCollection();
        $this->videos = new ArrayCollection();
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

    public function __toString()
    {
        return (string) $this->name;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }
    
    public function getCatagory(): ?Catagory
    {
        return $this->catagory;
    }

    public function setCatagory(?Catagory $catagory): self
    {
        $this->catagory= $catagory;

        return $this;
    }


    public function getCycle(): ?Cycle
    {
        return $this->cycle;
    }

    public function setCycle(?Cycle $cycle): self
    {
        $this->cycle = $cycle;

        return $this;
    }

    /**
     * @return Collection|Position[]
     */
    public function getStartPosition(): Collection
    {
        return $this->startPosition;
    }

    public function addStartPosition(Position $startPosition): self
    {
        if (!$this->startPosition->contains($startPosition)) {
            $this->startPosition[] = $startPosition;
        }

        return $this;
    }

    public function removeStartPosition(Position $startPosition): self
    {
        if ($this->startPosition->contains($startPosition)) {
            $this->startPosition->removeElement($startPosition);
        }

        return $this;
    }

    /**
     * @return Collection|Position[]
     */
    public function getEndPosition(): Collection
    {
        return $this->endPosition;
    }

    public function addEndPosition(Position $endPosition): self
    {
        if (!$this->endPosition->contains($endPosition)) {
            $this->endPosition[] = $endPosition;
        }

        return $this;
    }

    public function removeEndPosition(Position $endPosition): self
    {
        if ($this->endPosition->contains($endPosition)) {
            $this->endPosition->removeElement($endPosition);
        }

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setTechnique($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getTechnique() === $this) {
                $video->setTechnique(null);
            }
        }

        return $this;
    }
   
}
