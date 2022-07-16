<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
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
     * @ORM\Column(type="string", length=255, nullable=true)
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
}
