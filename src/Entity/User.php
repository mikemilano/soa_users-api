<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Table(name="users",
 *   indexes={
 *   @ORM\Index(name="user_active_lname", columns={"active", "last_name"})
 * })
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ApiResource
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", inversedBy="users")
     * @ORM\JoinTable(name="users_roles",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")})
     */
    private $roles;

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->roles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection|Role[]
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(Role $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        if ($this->roles->contains($role)) {
            $this->roles->removeElement($role);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getEmail();
    }

}
