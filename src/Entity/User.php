<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;



/**
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
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
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="date")
     */
    private $join_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $m_sesh_per_week;

    /**
     * @ORM\Column(type="integer")
     */
    private $m_sesh_per_variant;

    /**
     * @ORM\Column(type="integer")
     */
    private $f_sesh_per_week;

    /**
     * @ORM\Column(type="integer")
     */
    private $f_sesh_per_variant;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $m_offset;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $f_offset;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->join_date = new \DateTime();
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    public function getJoinDate(): ?\DateTimeInterface
    {
        return $this->join_date;
    }

    public function setJoinDate(\DateTimeInterface $join_date): self
    {
        $this->join_date = $join_date;

        return $this;
    }

    public function getMSeshPerWeek(): ?int
    {
        return $this->m_sesh_per_week;
    }

    public function setMSeshPerWeek(int $m_sesh_per_week): self
    {
        $this->m_sesh_per_week = $m_sesh_per_week;

        return $this;
    }

    public function getMSeshPerVariant(): ?int
    {
        return $this->m_sesh_per_variant;
    }

    public function setMSeshPerVariant(int $m_sesh_per_variant): self
    {
        $this->m_sesh_per_variant = $m_sesh_per_variant;

        return $this;
    }

    public function getFSeshPerWeek(): ?int
    {
        return $this->f_sesh_per_week;
    }

    public function setFSeshPerWeek(int $f_sesh_per_week): self
    {
        $this->f_sesh_per_week = $f_sesh_per_week;

        return $this;
    }

    public function getFSeshPerVariant(): ?int
    {
        return $this->f_sesh_per_variant;
    }

    public function setFSeshPerVariant(int $f_sesh_per_variant): self
    {
        $this->f_sesh_per_variant = $f_sesh_per_variant;

        return $this;
    }

    public function getMOffset(): ?int
    {
        return $this->m_offset;
    }

    public function setMOffset(?int $m_offset): self
    {
        $this->m_offset = $m_offset;

        return $this;
    }

    public function getFOffset(): ?int
    {
        return $this->f_offset;
    }

    public function setFOffset(?int $f_offset): self
    {
        $this->f_offset = $f_offset;

        return $this;
    }



    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }public function getRoles()
        {
            return array('ROLE_USER');
        }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, array('allowed_classes' => false));
    }
}
