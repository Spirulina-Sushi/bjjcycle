<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 */
class Player
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Top;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTop(): ?bool
    {
        return $this->Top;
    }

    public function setTop(bool $Top): self
    {
        $this->Top = $Top;

        return $this;
    }
}
