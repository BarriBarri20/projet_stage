<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 */
class Role
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $roleName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Roledossier::class, mappedBy="Roles")
     */
    private $roledossiers;

    public function __construct()
    {
        $this->roledossiers = new ArrayCollection();
    }

   

    



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleName(): ?string
    {
        return $this->roleName;
    }

    public function setRoleName(string $roleName): self
    {
        $this->roleName = $roleName;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function __toString()
    {
        return $this->libelle;
    }

    /**
     * @return Collection|Roledossier[]
     */
    public function getRoledossiers(): Collection
    {
        return $this->roledossiers;
    }

    public function addRoledossier(Roledossier $roledossier): self
    {
        if (!$this->roledossiers->contains($roledossier)) {
            $this->roledossiers[] = $roledossier;
            $roledossier->setRoles($this);
        }

        return $this;
    }

    public function removeRoledossier(Roledossier $roledossier): self
    {
        if ($this->roledossiers->contains($roledossier)) {
            $this->roledossiers->removeElement($roledossier);
            // set the owning side to null (unless already changed)
            if ($roledossier->getRoles() === $this) {
                $roledossier->setRoles(null);
            }
        }

        return $this;
    }

   

    

}
