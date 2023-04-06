<?php

namespace App\Entity;

use App\Repository\ServeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServeurRepository::class)
 */
class Serveur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AdresseIP;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomServeur;

     /**
     * @ORM\Column(name="`ssl`",type="boolean")
     */
    private $Ssl;

    public function isSsl(): ?bool
    {
        return $this->Ssl;
    }

    public function setSsl(bool $Ssl): self
    {
        $this->Ssl = $Ssl;

        return $this;
    }

    /**
     * @ORM\Column(name="`Port`",type="string", length=255)
     */
    private $Port;

     /**
     * @ORM\ManyToOne(targetEntity=TypeServeur::class, inversedBy="typeServeur")
     */
    private $typeServeur;



    /**
     * @ORM\OneToMany(targetEntity=Dossier::class, mappedBy="Dossier")
     */
    private $dossier;




    public function gettypeServeur(): ?TypeServeur
    {
        return $this->typeServeur;
    }

    public function settypeServeur(TypeServeur $typeServeur): self
    {
        $this->typeServeur = $typeServeur;

        return $this;
    }

    public function getdossier(): ?dossier
    {
        return $this->dossier;
    }

    public function setdossier(dossier $dossier): self
    {
        $this->dossier = $dossier;

        return $this;
    }

    public function __construct()
    {
        $this->types = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresseIP(): ?string
    {
        return $this->AdresseIP;
    }

    public function setAdresseIP(string $AdresseIP): self
    {
        $this->AdresseIP = $AdresseIP;

        return $this;
    }

    public function getNomServeur(): ?string
    {
        return $this->NomServeur;
    }

    public function setNomServeur(string $NomServeur): self
    {
        $this->NomServeur = $NomServeur;

        return $this;
    }

    public function getPort(): ?string
    {
        return $this->Port;
    }

    public function setPort(string $Port): self
    {
        $this->Port = $Port;

        return $this;
    }
   

    /**
     * @return Collection|TypeServeur[]
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(TypeServeur $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
            $type->setServeur($this);
        }

        return $this;
    }

    public function removeType(TypeServeur $type): self
    {
        if ($this->types->contains($type)) {
            $this->types->removeElement($type);
            // set the owning side to null (unless already changed)
            if ($type->getServeur() === $this) {
                $type->setServeur(null);
            }
        }

        return $this;
    }

    

    /**
     * @return Collection|Serveur[]
     */
    public function getServeur(): Collection
    {
        return $this->serveur;
    }

    public function addServeur(Serveur $serveur): self
    {
        if (!$this->serveur->contains($serveur)) {
            $this->serveur[] = $serveur;
            $serveur->setServeur($this);
        }

        return $this;
    }

    public function removeServeur(Serveur $serveur): self
    {
        if ($this->serveur->contains($serveur)) {
            $this->serveur->removeElement($serveur);
            // set the owning side to null (unless already changed)
            if ($serveur->getServeur() === $this) {
                $serveur->setServeur(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->NomServeur;
    }

}
