<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vintedLink = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $olxLink = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $allegroLink = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\Column]
    private ?bool $reserved = false;

    #[ORM\ManyToOne(inversedBy: 'reservedItems')]
    private ?User $reservedBy = null;

    #[ORM\Column]
    private ?bool $sold = false;

    #[ORM\ManyToOne]
    private ?User $boughtBy = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getVintedLink(): ?string
    {
        return $this->vintedLink;
    }

    public function setVintedLink(?string $vintedLink): static
    {
        $this->vintedLink = $vintedLink;

        return $this;
    }

    public function getOlxLink(): ?string
    {
        return $this->olxLink;
    }

    public function setOlxLink(?string $olxLink): static
    {
        $this->olxLink = $olxLink;

        return $this;
    }

    public function getAllegroLink(): ?string
    {
        return $this->allegroLink;
    }

    public function setAllegroLink(?string $allegroLink): static
    {
        $this->allegroLink = $allegroLink;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function isReserved(): ?bool
    {
        return $this->reserved;
    }

    public function setReserved(bool $reserved): static
    {
        $this->reserved = $reserved;

        return $this;
    }

    public function getReservedBy(): ?User
    {
        return $this->reservedBy;
    }

    public function setReservedBy(?User $reservedBy): static
    {
        $this->reservedBy = $reservedBy;

        return $this;
    }

    public function isSold(): ?bool
    {
        return $this->sold;
    }

    public function setSold(bool $sold): static
    {
        $this->sold = $sold;

        return $this;
    }

    public function getBoughtBy(): ?User
    {
        return $this->boughtBy;
    }

    public function setBoughtBy(?User $boughtBy): static
    {
        $this->boughtBy = $boughtBy;

        return $this;
    }
}
