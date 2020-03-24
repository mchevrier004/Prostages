<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormationRepository")
 */
class Formation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $diplome;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\OffreStage", inversedBy="formations")
     */
    private $stage;

    public function __construct()
    {
        $this->stage = new ArrayCollection();
    }

    public function __tostring(){
        return $this->getNom();
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

    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    public function setDiplome(string $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }

    /**
     * @return Collection|OffreStage[]
     */
    public function getStage(): Collection
    {
        return $this->stage;
    }

    public function addStage(OffreStage $stage): self
    {
        if (!$this->stage->contains($stage)) {
            $this->stage[] = $stage;
        }

        return $this;
    }

    public function removeStage(OffreStage $stage): self
    {
        if ($this->stage->contains($stage)) {
            $this->stage->removeElement($stage);
        }

        return $this;
    }
}
