<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OffreStageRepository")
 */
class OffreStage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Mail;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $Tel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(string $Mail): self
    {
        $this->Mail = $Mail;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->Tel;
    }

    public function setTel(?string $Tel): self
    {
        $this->Tel = $Tel;

        return $this;
    }
}
