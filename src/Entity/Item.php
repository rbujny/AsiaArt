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

//    #[ORM\Column(length: 255, nullable: true)]
//    private ?string $slug = null;

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

//    public function getSlug(): ?string
//    {
//        return $this->slug;
//    }
//
//    public function setSlug(?string $slug): static
//    {
//        $this->slug = $slug;
//
//        return $this;
//    }

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
}
