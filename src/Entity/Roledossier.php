<?php

namespace App\Entity;

use App\Repository\RoledossierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoledossierRepository::class)
 */
class Roledossier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Dossier::class, inversedBy="roledossiers")
     */
    private $Dossiers;

    /**
     * @ORM\ManyToOne(targetEntity=Role::class, inversedBy="roledossiers")
     */
    private $Roles;

    /**
     * @ORM\Column(type="boolean")
     */
    private $lecture;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ecriture;

    /**
     * @ORM\Column(type="boolean")
     */
    private $telechargement;

    /**
     * @ORM\Column(type="boolean")
     */
    private $affichage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDossiers(): ?Dossier
    {
        return $this->Dossiers;
    }

    public function setDossiers(?Dossier $Dossiers): self
    {
        $this->Dossiers = $Dossiers;

        return $this;
    }

    public function getRoles(): ?Role
    {
        return $this->Roles;
    }

    public function setRoles(?Role $Roles): self
    {
        $this->Roles = $Roles;

        return $this;
    }

    public function getLecture(): ?string
    {
        return $this->lecture;
    }

    public function setLecture(string $lecture): self
    {
        $this->lecture = $lecture;

        return $this;
    }

    public function getEcriture(): ?string
    {
        return $this->ecriture;
    }

    public function setEcriture(string $ecriture): self
    {
        $this->ecriture = $ecriture;

        return $this;
    }

    public function getTelechargement(): ?string
    {
        return $this->telechargement;
    }

    public function setTelechargement(string $telechargement): self
    {
        $this->telechargement = $telechargement;

        return $this;
    }

    public function getAffichage(): ?string
    {
        return $this->affichage;
    }

    public function setAffichage(string $affichage): self
    {
        $this->affichage = $affichage;

        return $this;
    }
}
