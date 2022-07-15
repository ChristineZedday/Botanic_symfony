<?php

namespace App\Entity;

use App\Repository\EmbranchementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmbranchementRepository::class)
 */
class Embranchement
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
     * @ORM\OneToMany(targetEntity=SousEmbranchement::class, mappedBy="embranchement")
     */
    private $sousEmbranchements;

    public function __construct()
    {
        $this->sousEmbranchements = new ArrayCollection();
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

    /**
     * @return Collection|SousEmbranchement[]
     */
    public function getSousEmbranchements(): Collection
    {
        return $this->sousEmbranchements;
    }

    public function addSousEmbranchement(SousEmbranchement $sousEmbranchement): self
    {
        if (!$this->sousEmbranchements->contains($sousEmbranchement)) {
            $this->sousEmbranchements[] = $sousEmbranchement;
            $sousEmbranchement->setEmbranchement($this);
        }

        return $this;
    }

    public function removeSousEmbranchement(SousEmbranchement $sousEmbranchement): self
    {
        if ($this->sousEmbranchements->removeElement($sousEmbranchement)) {
            // set the owning side to null (unless already changed)
            if ($sousEmbranchement->getEmbranchement() === $this) {
                $sousEmbranchement->setEmbranchement(null);
            }
        }

        return $this;
    }
}
