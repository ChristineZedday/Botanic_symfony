<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClasseRepository::class)
 */
class Classe
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
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $caracteres;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vernaculaire;

    /**
     * @ORM\ManyToOne(targetEntity=SuperClasse::class, inversedBy="classes")
     */
    private $superClasse;

    /**
     * @ORM\ManyToOne(targetEntity=SousEmbranchement::class, inversedBy="classes")
     */
    private $sousEmbranchement;

    
    /**
     * @ORM\OneToMany(targetEntity=SousClasse::class, mappedBy="classe")
     */
    private $sousClasses;

    /**
     * @ORM\ManyToOne(targetEntity=Embranchement::class, inversedBy="classes")
     */
    private $embranchement;

    public function __construct()
    {
        $this->sousClasses = new ArrayCollection();
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

    public function getCaracteres(): ?string
    {
        return $this->caracteres;
    }

    public function setCaracteres(?string $caracteres): self
    {
        $this->caracteres = $caracteres;

        return $this;
    }

    public function getVernaculaire(): ?string
    {
        return $this->vernaculaire;
    }

    public function setVernaculaire(?string $vernaculaire): self
    {
        $this->vernaculaire = $vernaculaire;

        return $this;
    }

    public function getSuperClasse(): ?SuperClasse
    {
        return $this->superClasse;
    }

    public function setSuperClasse(?SuperClasse $superClasse): self
    {
        $this->superClasse = $superClasse;

        return $this;
    }

    public function getSousEmbranchement(): ?SousEmbranchement
    {
        return $this->sousEmbranchement;
    }

    public function setSousEmbranchement(?SousEmbranchement $sousEmbranchement): self
    {
        $this->sousEmbranchement = $sousEmbranchement;

        return $this;
    }

    public function getEmbranchement(): ?string
    {
        return $this->embranchement;
    }

    public function setEmbranchement(?string $embranchement): self
    {
        $this->embranchement = $embranchement;

        return $this;
    }

    /**
     * @return Collection|SousClasse[]
     */
    public function getSousClasses(): Collection
    {
        return $this->sousClasses;
    }

    public function addSousClass(SousClasse $sousClass): self
    {
        if (!$this->sousClasses->contains($sousClass)) {
            $this->sousClasses[] = $sousClass;
            $sousClass->setClasse($this);
        }

        return $this;
    }

    public function removeSousClass(SousClasse $sousClass): self
    {
        if ($this->sousClasses->removeElement($sousClass)) {
            // set the owning side to null (unless already changed)
            if ($sousClass->getClasse() === $this) {
                $sousClass->setClasse(null);
            }
        }

        return $this;
    }
}
