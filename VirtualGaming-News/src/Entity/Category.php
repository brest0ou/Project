<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $type = null;

    #[ORM\ManyToMany(targetEntity: Game::class, mappedBy: 'gamesCategory')]
    private Collection $categoryGames;

    public function __construct()
    {
        $this->categoryGames = new ArrayCollection();
    }

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getCategoryGames(): Collection
    {
        return $this->categoryGames;
    }

    public function addCategoryGame(Game $categoryGame): self
    {
        if (!$this->categoryGames->contains($categoryGame)) {
            $this->categoryGames->add($categoryGame);
            $categoryGame->addGamesCategory($this);
        }

        return $this;
    }

    public function removeCategoryGame(Game $categoryGame): self
    {
        if ($this->categoryGames->removeElement($categoryGame)) {
            $categoryGame->removeGamesCategory($this);
        }

        return $this;
    }
    
    public function __toString()
    {
        return $this->getname();
    }
}

