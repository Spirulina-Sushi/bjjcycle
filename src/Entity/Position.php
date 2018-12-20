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
     * @ORM\ManyToOne(targetEntity="App\Entity\Subsystem", inversedBy="positions")
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Technique", mappedBy="startPosition")
     * @ORM\JoinTable(name="start_technique_position")
     */
    private $techniquesStart;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Technique", mappedBy="endPosition")
     * @ORM\JoinTable(name="end_technique_position")
     */
    private $techniquesEnd;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="currentPosition")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Video", mappedBy="position")
     */
    private $videos;

    public function __construct()
    {
        $this->techniques = new ArrayCollection();
        $this->techniquesEnd = new ArrayCollection();
        $this->techniquesStart = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->videos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubsystem(): ?Subsystem
    {
        return $this->subsystem;
    }

    public function setSubsystem(?Subsystem $subsystem): self
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
    public function getTechniquesStart(): Collection
    {
        return $this->techniquesStart;
    }

    public function addTechniquesStart(Technique $techniquesStart): self
    {
        if (!$this->techniquesStart->contains($techniquesStart)) {
            $this->techniquesStart[] = $techniquesStart;
            $techniquesStart->addStartPosition($this);
        }

        return $this;
    }

    public function removeTechniquesStart(Technique $techniquesStart): self
    {
        if ($this->techniquesStart->contains($techniquesStart)) {
            $this->techniquesStart->removeElement($techniquesStart);
            $techniquesStart->removeStartPosition($this);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCurrentPosition($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getCurrentPosition() === $this) {
                $user->setCurrentPosition(null);
            }
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
            $video->setPosition($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getPosition() === $this) {
                $video->setPosition(null);
            }
        }

        return $this;
    }
}
