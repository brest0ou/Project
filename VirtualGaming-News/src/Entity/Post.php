<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\Column(length: 50, nullable:true)]
    private ?string $status = null;

    #[ORM\Column(nullable:true)]
    private ?int $grades = null;

    #[ORM\Column(nullable:true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $posts = null;

    #[ORM\OneToMany(mappedBy: 'commentsPosts', targetEntity: Comment::class)]
    private Collection $postsComments;

    #[ORM\ManyToOne(inversedBy: 'postsGames')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Game $gamesPosts = null;

    public function __construct()
    {
        $this->postsComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getGrades(): ?int
    {
        return $this->grades;
    }

    public function setGrades(int $grades): self
    {
        $this->grades = $grades;

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

    public function getPosts(): ?User
    {
        return $this->posts;
    }

    public function setPosts(?User $posts): self
    {
        $this->posts = $posts;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getPostsComments(): Collection
    {
        return $this->postsComments;
    }

    public function addPostsComment(Comment $postsComment): self
    {
        if (!$this->postsComments->contains($postsComment)) {
            $this->postsComments->add($postsComment);
            $postsComment->setCommentsPosts($this);
        }

        return $this;
    }

    public function removePostsComment(Comment $postsComment): self
    {
        if ($this->postsComments->removeElement($postsComment)) {
            // set the owning side to null (unless already changed)
            if ($postsComment->getCommentsPosts() === $this) {
                $postsComment->setCommentsPosts(null);
            }
        }

        return $this;
    }

    public function getGamesPosts(): ?Game
    {
        return $this->gamesPosts;
    }

    public function setGamesPosts(?Game $gamesPosts): self
    {
        $this->gamesPosts = $gamesPosts;

        return $this;
    }
}
