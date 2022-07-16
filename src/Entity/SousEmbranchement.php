<?php

namespace App\Entity;

use App\Repository\SousEmbranchementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SousEmbranchementRepository::class)
 */
class SousEmbranchement
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vernaculaire;

    /**
     * @ORM\ManyToOne(targetEntity=Embranchement::class, inversedBy="sousEmbranchements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $embranchement;

    /**
     * @ORM\OneToMany(targetEntity=SuperClasse::class, mappedBy="sous_embranchement")
     */
    private $superClasses;

    /**
     * @ORM\OneToMany(targetEntity=Classe::class, mappedBy="sousEmbranchement")
     */
    private $classes;

    public function __construct()
    {
        $this->superClasses = new ArrayCollection();
        $this->classes = new ArrayCollection();
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

    public function getVernaculaire(): ?string
    {
        return $this->vernaculaire;
    }

    public function setVernaculaire(?string $vernaculaire): self
    {
        $this->vernaculaire = $vernaculaire;

        return $this;
    }

    public function getEmbranchement(): ?Embranchement
    {
        return $this->embranchement;
    }

    public function setEmbranchement(?Embranchement $embranchement): self
    {
        $this->embranchement = $embranchement;

        return $this;
    }

    /**
     * @return Collection|SuperClasse[]
     */
    public function getSuperClasses(): Collection
    {
        return $this->superClasses;
    }

    public function addSuperClass(SuperClasse $superClass): self
    {
        if (!$this->superClasses->contains($superClass)) {
            $this->superClasses[] = $superClass;
            $superClass->setSousEmbranchement($this);
        }

        return $this;
    }

    public function removeSuperClass(SuperClasse $superClass): self
    {
        if ($this->superClasses->removeElement($superClass)) {
            // set the owning side to null (unless already changed)
            if ($superClass->getSousEmbranchement() === $this) {
                $superClass->setSousEmbranchement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Classe[]
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
            $class->setSousEmbranchement($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getSousEmbranchement() === $this) {
                $class->setSousEmbranchement(null);
            }
        }

        return $this;
    }
}
