<?php

namespace App\Entity;

use App\Repository\SuperClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SuperClasseRepository::class)
 */
class SuperClasse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=SousEmbranchement::class, inversedBy="superClasses")
     */
    private $sous_embranchement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vernaculaire;

    /**
     * @ORM\ManyToOne(targetEntity=Embranchement::class, inversedBy="superClasses")
     */
    private $embranchement;

    /**
     * @ORM\OneToMany(targetEntity=Classe::class, mappedBy="superClasse")
     */
    private $classes;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSousEmbranchement(): ?SousEmbranchement
    {
        return $this->sous_embranchement;
    }

    public function setSousEmbranchement(?SousEmbranchement $sous_embranchement): self
    {
        $this->sous_embranchement = $sous_embranchement;

        return $this;
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
            $class->setSuperClasse($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getSuperClasse() === $this) {
                $class->setSuperClasse(null);
            }
        }

        return $this;
    }
}
