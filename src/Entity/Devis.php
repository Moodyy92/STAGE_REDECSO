<?php

namespace App\Entity;

use App\Repository\DevisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DevisRepository::class)
 */
class Devis
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="devis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $objet;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ref;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $signature;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptif;

    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, inversedBy="devis")
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity=Tache::class, inversedBy="devis")
     */
    private $taches;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->taches = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(?string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getSignature(): ?\DateTimeInterface
    {
        return $this->signature;
    }

    public function setSignature(?\DateTimeInterface $signature): self
    {
        $this->signature = $signature;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(?string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection|Tache[]
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTach(Tache $tach): self
    {
        if (!$this->taches->contains($tach)) {
            $this->taches[] = $tach;
        }

        return $this;
    }

    public function removeTach(Tache $tach): self
    {
        $this->taches->removeElement($tach);

        return $this;
    }
}
