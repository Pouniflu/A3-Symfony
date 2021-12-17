<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MissionRepository::class)
 */
class Mission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $priority;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $completion_date;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="missions")
     */
    private $superHeroes;

    public function __construct()
    {
        $this->superHeroes = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function setPriority(string $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getCompletionDate(): ?\DateTimeInterface
    {
        return $this->completion_date;
    }

    public function setCompletionDate(?\DateTimeInterface $completion_date): self
    {
        $this->completion_date = $completion_date;

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

    /**
     * @return Collection|User[]
     */
    public function getSuperHeroes(): Collection
    {
        return $this->superHeroes;
    }

    public function addSuperHero(User $superHero): self
    {
        if (!$this->superHeroes->contains($superHero)) {
            $this->superHeroes[] = $superHero;
        }

        return $this;
    }

    public function removeSuperHero(User $superHero): self
    {
        $this->superHeroes->removeElement($superHero);

        return $this;
    }
}
