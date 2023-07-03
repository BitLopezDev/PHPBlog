<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?string $content = null;

    #[ORM\ManyToMany(targetEntity: Users::class, inversedBy: 'comments')]
    private Collection $authors;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $sources = null;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(Users $author): static
    {
        if (!$this->authors->contains($author)) {
            $this->authors->add($author);
        }

        return $this;
    }

    public function removeAuthor(Users $author): static
    {
        $this->authors->removeElement($author);

        return $this;
    }

    public function getSources(): ?string
    {
        return $this->sources;
    }

    public function setSources(?string $sources): static
    {
        $this->sources = $sources;

        return $this;
    }
}
