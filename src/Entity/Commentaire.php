<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contenu;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cote;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $encodage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Internaute", inversedBy="commentaire")
     */
    private $internaute;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prestataire", inversedBy="commentaire")
     */
    private $prestataire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Abus", mappedBy="commentaire")
     */
    private $abus;

    public function __construct()
    {
        $this->abus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getCote(): ?int
    {
        return $this->cote;
    }

    public function setCote(?int $cote): self
    {
        $this->cote = $cote;

        return $this;
    }

    public function getEncodage(): ?int
    {
        return $this->encodage;
    }

    public function setEncodage(?int $encodage): self
    {
        $this->encodage = $encodage;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getInternaute(): ?Internaute
    {
        return $this->internaute;
    }

    public function setInternaute(?Internaute $internaute): self
    {
        $this->internaute = $internaute;

        return $this;
    }

    public function getPrestataire(): ?Prestataire
    {
        return $this->prestataire;
    }

    public function setPrestataire(?Prestataire $prestataire): self
    {
        $this->prestataire = $prestataire;

        return $this;
    }

    /**
     * @return Collection|Abus[]
     */
    public function getAbus(): Collection
    {
        return $this->abus;
    }

    public function addAbus(Abus $abus): self
    {
        if (!$this->abus->contains($abus)) {
            $this->abus[] = $abus;
            $abus->setCommentaire($this);
        }

        return $this;
    }

    public function removeAbus(Abus $abus): self
    {
        if ($this->abus->contains($abus)) {
            $this->abus->removeElement($abus);
            // set the owning side to null (unless already changed)
            if ($abus->getCommentaire() === $this) {
                $abus->setCommentaire(null);
            }
        }

        return $this;
    }
}
