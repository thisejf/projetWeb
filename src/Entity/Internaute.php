<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InternauteRepository")
 */
class Internaute extends Utilisateur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $newsLetter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Images", cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="internaute")
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Abus", mappedBy="internaute")
     */
    private $abus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Position")
     */
    private $position;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Prestataire", mappedBy="internaute")
     */
    private $prestataires;

    public function __construct()
    {
        $this->commentaire = new ArrayCollection();
        $this->abus = new ArrayCollection();
        $this->prestataires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNewsLetter(): ?bool
    {
        return $this->newsLetter;
    }

    public function setNewsLetter(?bool $newsLetter): self
    {
        $this->newsLetter = $newsLetter;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getImage(): ?Images
    {
        return $this->image;
    }

    public function setImage(?Images $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaire(): Collection
    {
        return $this->commentaire;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire[] = $commentaire;
            $commentaire->setInternaute($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaire->contains($commentaire)) {
            $this->commentaire->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getInternaute() === $this) {
                $commentaire->setInternaute(null);
            }
        }

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
            $abus->setInternaute($this);
        }

        return $this;
    }

    public function removeAbus(Abus $abus): self
    {
        if ($this->abus->contains($abus)) {
            $this->abus->removeElement($abus);
            // set the owning side to null (unless already changed)
            if ($abus->getInternaute() === $this) {
                $abus->setInternaute(null);
            }
        }

        return $this;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return Collection|Prestataire[]
     */
    public function getPrestataires(): Collection
    {
        return $this->prestataires;
    }

    public function addPrestataire(Prestataire $prestataire): self
    {
        if (!$this->prestataires->contains($prestataire)) {
            $this->prestataires[] = $prestataire;
            $prestataire->addInternaute($this);
        }

        return $this;
    }

    public function removePrestataire(Prestataire $prestataire): self
    {
        if ($this->prestataires->contains($prestataire)) {
            $this->prestataires->removeElement($prestataire);
            $prestataire->removeInternaute($this);
        }

        return $this;
    }
}
