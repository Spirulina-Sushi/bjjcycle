<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CycleRepository")
 */
class Cycle
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
     * @ORM\OneToMany(targetEntity="App\Entity\Technique", mappedBy="cycle")
     */
    private $techniques;

    public function __construct()
    {
        $this->techniques = new ArrayCollection();
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
     * @return Collection|Technique[]
     */
    public function getTechniques(): Collection
    {
        return $this->techniques;
    }

    public function addTechnique(Technique $technique): self
    {
        if (!$this->techniques->contains($technique)) {
            $this->techniques[] = $technique;
            $technique->setCycle($this);
        }

        return $this;
    }

    public function removeTechnique(Technique $technique): self
    {
        if ($this->techniques->contains($technique)) {
            $this->techniques->removeElement($technique);
            // set the owning side to null (unless already changed)
            if ($technique->getCycle() === $this) {
                $technique->setCycle(null);
            }
        }

        return $this;
    }
}
