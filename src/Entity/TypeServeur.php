<?php

namespace App\Entity;

use App\Repository\TypeServeurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeServeurRepository::class)
 */
class TypeServeur
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
    private $codeType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

     /**
     * @ORM\Column(type="string", length=255)
     */
    private $Protocol;
   /**
     * @ORM\OneToMany(targetEntity=Serveur::class, mappedBy="serveur")
     */
    private $serveur;

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeType(): ?string
    {
        return $this->codeType;
    }

    public function setCodeType(string $codeType): self
    {
        $this->codeType = $codeType;

        return $this;
    }

    public function getProtocol(): ?string
    {
        return $this->Protocol;
    }

    public function setProtocol(string $Protocol): self
    {
        $this->Protocol = $Protocol;

        return $this;
    }

    public function getServeur(): ?Serveur
    {
        return $this->serveur;
    }

    public function setServeur(?Serveur $serveur): self
    {
        $this->serveur = $serveur;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
    public function __toString()
    {
        return $this->codeType;
    }
}
