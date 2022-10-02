<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $comments = null;

    #[ORM\ManyToOne(inversedBy: 'postsComments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $commentsPosts = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getComments(): ?User
    {
        return $this->comments;
    }

    public function setComments(?User $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getCommentsPosts(): ?Post
    {
        return $this->commentsPosts;
    }

    public function setCommentsPosts(?Post $commentsPosts): self
    {
        $this->commentsPosts = $commentsPosts;

        return $this;
    }
}
