<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $route = null;

    #[ORM\ManyToOne(targetEntity:"Image" ,inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Item $item1 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoute(): ?string
    {
        return $this->route;
    }

    public function setRoute(string $route): static
    {
        $this->route = $route;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->item1;
    }

    public function setItem(?Item $item1): static
    {
        $this->item1 = $item1;

        return $this;
    }
}
