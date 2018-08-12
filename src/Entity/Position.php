<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PositionRepository")
 */
class Position
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SubSystem", inversedBy="positions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subsystem;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArmOrientation", inversedBy="positions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $armOrientation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\LegOrientation", inversedBy="positions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $legOrientation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Technique", mappedBy="startPosition")
     */
    private $techniques;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Technique", mappedBy="endPosition")
     */
    private $techniquesEnd;

    public function __construct()
    {
        $this->techniques = new ArrayCollection();
        $this->techniquesEnd = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubsystem(): ?SubSystem
    {
        return $this->subsystem;
    }

    public function setSubsystem(?SubSystem $subsystem): self
    {
        $this->subsystem = $subsystem;

        return $this;
    }

    public function getArmOrientation(): ?ArmOrientation
    {
        return $this->armOrientation;
    }

    public function setArmOrientation(?ArmOrientation $armOrientation): self
    {
        $this->armOrientation = $armOrientation;

        return $this;
    }

    public function getLegOrientation(): ?LegOrientation
    {
        return $this->legOrientation;
    }

    public function setLegOrientation(?LegOrientation $legOrientation): self
    {
        $this->legOrientation = $legOrientation;

        return $this;
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
            $technique->setStartPosition($this);
        }

        return $this;
    }

    public function removeTechnique(Technique $technique): self
    {
        if ($this->techniques->contains($technique)) {
            $this->techniques->removeElement($technique);
            // set the owning side to null (unless already changed)
            if ($technique->getStartPosition() === $this) {
                $technique->setStartPosition(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Technique[]
     */
    public function getTechniquesEnd(): Collection
    {
        return $this->techniquesEnd;
    }

    public function addTechniquesEnd(Technique $techniquesEnd): self
    {
        if (!$this->techniquesEnd->contains($techniquesEnd)) {
            $this->techniquesEnd[] = $techniquesEnd;
            $techniquesEnd->setEndPosition($this);
        }

        return $this;
    }

    public function removeTechniquesEnd(Technique $techniquesEnd): self
    {
        if ($this->techniquesEnd->contains($techniquesEnd)) {
            $this->techniquesEnd->removeElement($techniquesEnd);
            // set the owning side to null (unless already changed)
            if ($techniquesEnd->getEndPosition() === $this) {
                $techniquesEnd->setEndPosition(null);
            }
        }

        return $this;
    }
}
