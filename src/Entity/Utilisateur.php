<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"internaute" = "Internaute", "prestataire" = "Prestataire"})
 */
abstract class Utilisateur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $adresseNumero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $adresseRue;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $banni;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $eMail;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $inscriptionConf;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $inscription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $motDePasse;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $nbEssaisInfructueux;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $typeUtilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CodePostal")
     */
    protected $codePostal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localite")
     */
    protected $localite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commune")
     */
    protected $commune;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresseNumero(): ?string
    {
        return $this->adresseNumero;
    }

    public function setAdresseNumero(?string $adresseNumero): self
    {
        $this->adresseNumero = $adresseNumero;

        return $this;
    }

    public function getAdresseRue(): ?string
    {
        return $this->adresseRue;
    }

    public function setAdresseRue(?string $adresseRue): self
    {
        $this->adresseRue = $adresseRue;

        return $this;
    }

    public function getBanni(): ?bool
    {
        return $this->banni;
    }

    public function setBanni(?bool $banni): self
    {
        $this->banni = $banni;

        return $this;
    }

    public function getEMail(): ?string
    {
        return $this->eMail;
    }

    public function setEMail(?string $eMail): self
    {
        $this->eMail = $eMail;

        return $this;
    }

    public function getInscriptionConf(): ?bool
    {
        return $this->inscriptionConf;
    }

    public function setInscriptionConf(?bool $inscriptionConf): self
    {
        $this->inscriptionConf = $inscriptionConf;

        return $this;
    }

    public function getInscription(): ?\DateTimeInterface
    {
        return $this->inscription;
    }

    public function setInscription(?\DateTimeInterface $inscription): self
    {
        $this->inscription = $inscription;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(?string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getNbEssaisInfructueux(): ?int
    {
        return $this->nbEssaisInfructueux;
    }

    public function setNbEssaisInfructueux(?int $nbEssaisInfructueux): self
    {
        $this->nbEssaisInfructueux = $nbEssaisInfructueux;

        return $this;
    }

    public function getTypeUtilisateur(): ?string
    {
        return $this->typeUtilisateur;
    }

    public function setTypeUtilisateur(?string $typeUtilisateur): self
    {
        $this->typeUtilisateur = $typeUtilisateur;

        return $this;
    }

    public function getCodePostal(): ?CodePostal
    {
        return $this->codePostal;
    }

    public function setCodePostal(?CodePostal $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getLocalite(): ?Localite
    {
        return $this->localite;
    }

    public function setLocalite(?Localite $localite): self
    {
        $this->localite = $localite;

        return $this;
    }

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): self
    {
        $this->commune = $commune;

        return $this;
    }
}
