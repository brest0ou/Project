<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    
    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $price = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalWeight = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $duration = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 50)]
    private ?string $develop = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updateAt = null;

    
    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn]
    private ?User $users = null;

    #[ORM\OneToMany(mappedBy: 'gamesPosts', targetEntity: Post::class)]
    private Collection $postsGames;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'categoryGames')]
    private Collection $gamesCategory;

    #[ORM\OneToMany(mappedBy: 'gamesPictures', targetEntity: Pictures::class)]
    private Collection $picturesGames;

    public function __construct()
    {
        $this->postsGames = new ArrayCollection();
        $this->gamesCategory = new ArrayCollection();
        $this->picturesGames = new ArrayCollection();
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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTotalWeight(): ?float
    {
        return $this->totalWeight;
    }

    public function setTotalWeight(float $totalWeight): self
    {
        $this->totalWeight = $totalWeight;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDevelop(): ?string
    {
        return $this->develop;
    }

    public function setDevelop(string $develop): self
    {
        $this->develop = $develop;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeImmutable $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }
    // erreur user is not possible String

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPostsGames(): Collection
    {
        return $this->postsGames;
    }

    public function addPostsGame(Post $postsGame): self
    {
        if (!$this->postsGames->contains($postsGame)) {
            $this->postsGames->add($postsGame);
        }

        return $this;
    }

    public function removePostsGame(Post $postsGame): self
    {
        $this->postsGames->removeElement($postsGame);

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getGamesCategory(): Collection
    {
        
        return $this->gamesCategory;
    }

    public function addGamesCategory(Category $gamesCategory): self
    {
        if (!$this->gamesCategory->contains($gamesCategory)) {
            $this->gamesCategory->add($gamesCategory);
        }

        return $this;
    }

    public function removeGamesCategory(Category $gamesCategory): self
    {
        $this->gamesCategory->removeElement($gamesCategory);

        return $this;
    }

    /**
     * @return Collection<int, Pictures>
     */
    public function getPicturesGames(): Collection
    {
        return $this->picturesGames;
    }

    public function addPicturesGame(Pictures $picturesGame): self
    {
        if (!$this->picturesGames->contains($picturesGame)) {
            $this->picturesGames->add($picturesGame);
            $picturesGame->setGamesPictures($this);
        }

        return $this;
    }

    public function removePicturesGame(Pictures $picturesGame): self
    {
        if ($this->picturesGames->removeElement($picturesGame)) {
            // set the owning side to null (unless already changed)
            if ($picturesGame->getGamesPictures() === $this) {
                $picturesGame->setGamesPictures(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getName();
        return $this->getUsers();
    }
}
