<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrepriseRepository")
 */
class Entreprise
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message = "Vous devez saisir le nom de l'entreprise.")
     * @Assert\Length(
     *      min = 4,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins 4 caractères."
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message = "Vous devez saisir le type de l'entreprise (son activité).")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     * @Assert\Url(message = "Cette adresse url est invalide.")
     */
    private $site;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OffreStage", mappedBy="entreprise")
     */
    private $stages;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $tel;

    public function __construct()
    {
        $this->stages = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(?string $site): self
    {
        $this->site = $site;

        return $this;
    }

    /**
     * @return Collection|OffreStage[]
     */
    public function getStages(): Collection
    {
        return $this->stages;
    }

    public function addStage(OffreStage $stage): self
    {
        if (!$this->stages->contains($stage)) {
            $this->stages[] = $stage;
            $stage->setEntreprise($this);
        }

        return $this;
    }

    public function removeStage(OffreStage $stage): self
    {
        if ($this->stages->contains($stage)) {
            $this->stages->removeElement($stage);
            // set the owning side to null (unless already changed)
            if ($stage->getEntreprise() === $this) {
                $stage->setEntreprise(null);
            }
        }

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

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }
}
