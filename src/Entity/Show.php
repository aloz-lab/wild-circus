<?php

namespace App\Entity;

use App\Repository\ShowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShowRepository::class)
 * @ORM\Table(name="`show`")
 */
class Show
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $summary;

    /**
     * @ORM\Column(type="date")
     */
    private $show_date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $adult_price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $child_price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $group_price;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="performance")
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity=Artist::class, mappedBy="shows")
     */
    private $artists;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->artists = new ArrayCollection();
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getShowDate(): ?\DateTimeInterface
    {
        return $this->show_date;
    }

    public function setShowDate(\DateTimeInterface $show_date): self
    {
        $this->show_date = $show_date;

        return $this;
    }

    public function getAdultPrice(): ?int
    {
        return $this->adult_price;
    }

    public function setAdultPrice(?int $adult_price): self
    {
        $this->adult_price = $adult_price;

        return $this;
    }

    public function getChildPrice(): ?int
    {
        return $this->child_price;
    }

    public function setChildPrice(?int $child_price): self
    {
        $this->child_price = $child_price;

        return $this;
    }

    public function getGroupPrice(): ?int
    {
        return $this->group_price;
    }

    public function setGroupPrice(?int $group_price): self
    {
        $this->group_price = $group_price;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPerformance($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getPerformance() === $this) {
                $comment->setPerformance(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Artist[]
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artist $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists[] = $artist;
            $artist->addShow($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): self
    {
        if ($this->artists->contains($artist)) {
            $this->artists->removeElement($artist);
            $artist->removeShow($this);
        }

        return $this;
    }
}
