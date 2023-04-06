<?php

namespace App\Entity;

use App\Repository\DossierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DossierRepository::class)
 */
class Dossier
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
    private $nom;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

 

    

    /**
     * @ORM\ManyToOne(targetEntity=Serveur::class, inversedBy="serveur")
     */
    private $serveur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $display;

    /**
     * @ORM\Column(type="boolean")
     */
    private $deleted;

    /**
     * @ORM\OneToMany(targetEntity=Dossier::class, mappedBy="parent")
     */
    private $dossiers;

    /**
     * @ORM\ManyToOne(targetEntity=Dossier::class, inversedBy="Dossier")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=Roledossier::class, mappedBy="Dossiers",  
     *   *     fetch="EXTRA_LAZY",
     *     orphanRemoval=true,
     *     cascade={"persist"})
     */
     
    private $roledossiers;











  

    public function __construct()
    {
        //$this->Roledossier = new ArrayCollection();
        $this->dossier = new ArrayCollection();
        $this->serveurs = new ArrayCollection();
        $this->dossiers = new ArrayCollection();
        $this->roledossiers = new ArrayCollection();
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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }


    public function getDossier(): ?serveur
    {
        return $this->dossier;
    }

    public function setDossier(?serveur $dossier): self
    {
        $this->dossier = $dossier;

        return $this;
    }

    public function addDossier(serveur $dossier): self
    {
        if (!$this->dossier->contains($dossier)) {
            $this->dossier[] = $dossier;
            $dossier->setDossier($this);
        }

        return $this;
    }

    public function removeDossier(serveur $dossier): self
    {
        if ($this->dossier->contains($dossier)) {
            $this->dossier->removeElement($dossier);
            // set the owning side to null (unless already changed)
            if ($dossier->getDossier() === $this) {
                $dossier->setDossier(null);
            }
        }

        return $this;
    }

    public function getServeur(): ?serveur
    {
        return $this->serveur;
    }

    public function setServeur(string $serveur): self
    {
        $this->serveur = $serveur;

        return $this;
    }

    /**
     * @return Collection|Serveur[]
     */
    public function getServeurs(): Collection
    {
        return $this->serveurs;
    }

    public function addServeur(Serveur $serveur): self
    {
        if (!$this->serveurs->contains($serveur)) {
            $this->serveurs[] = $serveur;
            $serveur->setDossier($this);
        }

        return $this;
    }

    public function removeServeur(Serveur $serveur): self
    {
        if ($this->serveurs->contains($serveur)) {
            $this->serveurs->removeElement($serveur);
            // set the owning side to null (unless already changed)
            if ($serveur->getDossier() === $this) {
                $serveur->setDossier(null);
            }
        }

        return $this;
    }

    public function getParentid(): ?dossier
    {
        return $this->parentid;
    }

    public function setParentid(?dossier $parentid): self
    {
        $this->parentid = $parentid;

        return $this;
    }

    public function getDisplay(): ?bool
    {
        return $this->display;
    }

    public function setDisplay(bool $display): self
    {
        $this->display = $display;

        return $this;
    }
    public function __toString()
    {
        return $this->nom;
    }
    public function getDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|Dossier[]
     */
    public function getDossiers(): Collection
    {
        
        
        return $this->dossiers;
    }

    /**
     * @return Collection|RoleDossier[]
     */
    public function getRoledossiers(): Collection
    {
        return $this->roledossiers;
    }

    public function addRoledossier(RoleDossier $roledossier): self
    {
        if (!$this->roledossiers->contains($roledossier)) {
            $this->roledossiers[] = $roledossier;
            $roledossier->setDossiers($this);
        }

        return $this;
    }

    public function removeRoledossier(RoleDossier $roledossier): self
    {
        if ($this->roledossiers->contains($roledossier)) {
            $this->roledossiers->removeElement($roledossier);
            // set the owning side to null (unless already changed)
            if ($roledossier->getDossiers() === $this) {
                $roledossier->setDossiers(null);
            }
        }

        return $this;
    }

   
}
