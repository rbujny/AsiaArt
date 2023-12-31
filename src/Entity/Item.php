<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

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

    #[ORM\Column]
    private ?bool $sold = false;

    #[ORM\OneToOne(mappedBy: 'item', cascade: ['persist', 'remove'])]
    private ?Review $review = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    private ?User $Customer = null;
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

    public function isSold(): ?bool
    {
        return $this->sold;
    }

    public function setSold(bool $sold): static
    {
        $this->sold = $sold;

        return $this;
    }

    public function getReview(): ?Review
    {
        return $this->review;
    }

    public function setReview(Review $review): static
    {
        // set the owning side of the relation if necessary
        if ($review->getItem() !== $this) {
            $review->setItem($this);
        }

        $this->review = $review;

        return $this;
    }

    public function getImage(): ?string
    {
        return "/img/".$this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getCustomer(): ?User
    {
        return $this->Customer;
    }

    public function setCustomer(?User $Customer): static
    {
        $this->Customer = $Customer;

        return $this;
    }




}
