<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="integer")
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $telephone;


    /**
     * @ORM\Column(type="integer")
     */
    private $capital;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeAPE;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numTVAIntracommunautaire;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeBanque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeGuichet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeBIC;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numCompte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cleCompte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $domiciliationCompte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $IBAN;

    /**
     * @ORM\Column(type="string", length=255, nullable="true")
     */
    private $logo;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="entreprises")
     */
    private $users;

    public function __construct()
    {
        $this->directeur = new ArrayCollection();
        $this->directeurTechnique = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(int $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getCapital(): ?int
    {
        return $this->capital;
    }

    public function setCapital(int $capital): self
    {
        $this->capital = $capital;

        return $this;
    }

    public function getCodeAPE(): ?string
    {
        return $this->codeAPE;
    }

    public function setCodeAPE(string $codeAPE): self
    {
        $this->codeAPE = $codeAPE;

        return $this;
    }

    public function getNumTVAIntracommunautaire(): ?string
    {
        return $this->numTVAIntracommunautaire;
    }

    public function setNumTVAIntracommunautaire(string $numTVAIntracommunautaire): self
    {
        $this->numTVAIntracommunautaire = $numTVAIntracommunautaire;

        return $this;
    }

    public function getCodeBanque(): ?string
    {
        return $this->codeBanque;
    }

    public function setCodeBanque(string $codeBanque): self
    {
        $this->codeBanque = $codeBanque;

        return $this;
    }

    public function getCodeGuichet(): ?string
    {
        return $this->codeGuichet;
    }

    public function setCodeGuichet(string $codeGuichet): self
    {
        $this->codeGuichet = $codeGuichet;

        return $this;
    }

    public function getCodeBIC(): ?string
    {
        return $this->codeBIC;
    }

    public function setCodeBIC(string $codeBIC): self
    {
        $this->codeBIC = $codeBIC;

        return $this;
    }

    public function getNumCompte(): ?string
    {
        return $this->numCompte;
    }

    public function setNumCompte(string $numCompte): self
    {
        $this->numCompte = $numCompte;

        return $this;
    }

    public function getCleCompte(): ?string
    {
        return $this->cleCompte;
    }

    public function setCleCompte(string $cleCompte): self
    {
        $this->cleCompte = $cleCompte;

        return $this;
    }

    public function getDomiciliationCompte(): ?string
    {
        return $this->domiciliationCompte;
    }

    public function setDomiciliationCompte(string $domiciliationCompte): self
    {
        $this->domiciliationCompte = $domiciliationCompte;

        return $this;
    }

    public function getIBAN(): ?string
    {
        return $this->IBAN;
    }

    public function setIBAN(string $IBAN): self
    {
        $this->IBAN = $IBAN;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addEntreprise($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeEntreprise($this);
        }

        return $this;
    }

}
