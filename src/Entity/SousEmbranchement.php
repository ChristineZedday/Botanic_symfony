<?php

namespace App\Entity;

use App\Repository\SousEmbranchementRepository;
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
}
