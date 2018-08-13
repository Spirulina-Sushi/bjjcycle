<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Position", inversedBy="techniques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $startPosition;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Position", inversedBy="techniquesEnd")
     * @ORM\JoinColumn(nullable=false)
     */
    private $endPosition;

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
     * @ORM\ManyToMany(targetEntity="App\Entity\Video", inversedBy="techniques")
     */
    private $video;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Game")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

    public function __construct()
    {
        $this->video = new ArrayCollection();
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

    public function getStartPosition(): ?Position
    {
        return $this->startPosition;
    }

    public function setStartPosition(?Position $startPosition): self
    {
        $this->startPosition = $startPosition;

        return $this;
    }

    public function getEndPosition(): ?Position
    {
        return $this->endPosition;
    }

    public function setEndPosition(?Position $endPosition): self
    {
        $this->endPosition = $endPosition;

        return $this;
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

    /**
     * @return Collection|Video[]
     */
    public function getVideo(): Collection
    {
        return $this->video;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->video->contains($video)) {
            $this->video[] = $video;
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->video->contains($video)) {
            $this->video->removeElement($video);
        }

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }
   
}
