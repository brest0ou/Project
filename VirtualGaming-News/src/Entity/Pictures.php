<?php

namespace App\Entity;

use App\Repository\PicturesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PicturesRepository::class)]
class Pictures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'picturesGames')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $gamesPictures = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getGamesPictures(): ?Game
    {
        return $this->gamesPictures;
    }

    public function setGamesPictures(?Game $gamesPictures): self
    {
        $this->gamesPictures = $gamesPictures;

        return $this;
    }
}
