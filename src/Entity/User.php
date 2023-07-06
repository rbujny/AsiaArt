<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'reservedBy', targetEntity: Item::class)]
    private Collection $reservedItems;

    #[ORM\OneToMany(mappedBy: 'boughtBy', targetEntity: Item::class)]
    private Collection $boughtItems;

    public function __construct()
    {
        $this->reservedItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getReservedItems(): Collection
    {
        return $this->reservedItems;
    }

    public function addReservedItem(Item $reservedItem): static
    {
        if (!$this->reservedItems->contains($reservedItem)) {
            $this->reservedItems->add($reservedItem);
            $reservedItem->setReservedBy($this);
        }

        return $this;
    }

    public function removeReservedItem(Item $reservedItem): static
    {
        if ($this->reservedItems->removeElement($reservedItem)) {
            // set the owning side to null (unless already changed)
            if ($reservedItem->getReservedBy() === $this) {
                $reservedItem->setReservedBy(null);
            }
        }

        return $this;
    }



    public function getBoughtItems(): Collection
    {
        return $this->boughtItems;
    }

    public function addBoughtItems(Item $boughtItems): static
    {
        if (!$this->reservedItems->contains($boughtItems)) {
            $this->reservedItems->add($boughtItems);
            $boughtItems->setReservedBy($this);
        }

        return $this;
    }

    public function removeBoughtItems(Item $boughtItems): static
    {
        if ($this->reservedItems->removeElement($$boughtItems)) {
            // set the owning side to null (unless already changed)
            if ($boughtItems->getReservedBy() === $this) {
                $boughtItems->setReservedBy(null);
            }
        }

        return $this;
    }
}
