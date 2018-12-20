<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\System", mappedBy="game")
     */
    private $system;

    public function __construct()
    {
        $this->system = new ArrayCollection();
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

    /**
     * @return Collection|System[]
     */
    public function getSystem(): Collection
    {
        return $this->system;
    }

    public function addSystem(System $system): self
    {
        if (!$this->system->contains($system)) {
            $this->system[] = $system;
            $system->setGame($this);
        }

        return $this;
    }

    public function removeSystem(System $system): self
    {
        if ($this->system->contains($system)) {
            $this->system->removeElement($system);
            // set the owning side to null (unless already changed)
            if ($system->getGame() === $this) {
                $system->setGame(null);
            }
        }

        return $this;
    }
}
