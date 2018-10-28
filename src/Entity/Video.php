<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Position", inversedBy="videos")
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Technique", inversedBy="videos")
     */
    private $technique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $start;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stop;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getTechnique(): ?Technique
    {
        return $this->technique;
    }

    public function setTechnique(?Technique $technique): self
    {
        $this->technique = $technique;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getStart(): ?int
    {
        return $this->start;
    }

    public function setStart(?int $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getStop(): ?int
    {
        return $this->stop;
    }

    public function setStop(?int $stop): self
    {
        $this->stop = $stop;

        return $this;
    }

    public function getUrlStartTime(): ?string
    {
        return $this->url."&t=".$this->start."s";
    }
}
