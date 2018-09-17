<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SystemRepository")
 */
class System
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
     * @ORM\OneToMany(targetEntity="App\Entity\Subsystem", mappedBy="system")
     */
    private $subsystem;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Game", inversedBy="system")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

    public function __construct()
    {
        $this->subsystem = new ArrayCollection();
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

    /**
     * @return Collection|Subsystem[]
     */
    public function getSubsystem(): Collection
    {
        return $this->subsystem;
    }

    public function addSubsystem(Subsystem $subsystem): self
    {
        if (!$this->subsystem->contains($subsystem)) {
            $this->subsystem[] = $subsystem;
            $subsystem->setSystem($this);
        }

        return $this;
    }

    public function removeSubsystem(Subsystem $subsystem): self
    {
        if ($this->subsystem->contains($subsystem)) {
            $this->subsystem->removeElement($subsystem);
            // set the owning side to null (unless already changed)
            if ($subsystem->getSystem() === $this) {
                $subsystem->setSystem(null);
            }
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
