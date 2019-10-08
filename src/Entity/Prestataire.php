<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrestataireRepository")
 */
class Prestataire extends Utilisateur
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
    private $eMailContact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numTel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numTVA;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siteInternet;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CategorieDeServices", inversedBy="prestataires")
     */
    private $categorieDeServices;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Promotion", mappedBy="prestataire")
     */
    private $promotion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stage", mappedBy="prestataire")
     */
    private $stage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="prestataire")
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Images", mappedBy="prestataire")
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Images", mappedBy="prestatairePhotos")
     */
    private $images;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Internaute", inversedBy="prestataires")
     */
    private $internaute;

    public function __construct()
    {
        $this->categorieDeServices = new ArrayCollection();
        $this->promotion = new ArrayCollection();
        $this->stage = new ArrayCollection();
        $this->commentaire = new ArrayCollection();
        $this->image = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->internaute = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEMailContact(): ?string
    {
        return $this->eMailContact;
    }

    public function setEMailContact(?string $eMailContact): self
    {
        $this->eMailContact = $eMailContact;

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

    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(?string $numTel): self
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getNumTVA(): ?string
    {
        return $this->numTVA;
    }

    public function setNumTVA(?string $numTVA): self
    {
        $this->numTVA = $numTVA;

        return $this;
    }

    public function getSiteInternet(): ?string
    {
        return $this->siteInternet;
    }

    public function setSiteInternet(?string $siteInternet): self
    {
        $this->siteInternet = $siteInternet;

        return $this;
    }

    /**
     * @return Collection|CategorieDeServices[]
     */
    public function getCategorieDeServices(): Collection
    {
        return $this->categorieDeServices;
    }

    public function addCategorieDeService(CategorieDeServices $categorieDeService): self
    {
        if (!$this->categorieDeServices->contains($categorieDeService)) {
            $this->categorieDeServices[] = $categorieDeService;
        }

        return $this;
    }

    public function removeCategorieDeService(CategorieDeServices $categorieDeService): self
    {
        if ($this->categorieDeServices->contains($categorieDeService)) {
            $this->categorieDeServices->removeElement($categorieDeService);
        }

        return $this;
    }

    /**
     * @return Collection|Promotion[]
     */
    public function getPromotion(): Collection
    {
        return $this->promotion;
    }

    public function addPromotion(Promotion $promotion): self
    {
        if (!$this->promotion->contains($promotion)) {
            $this->promotion[] = $promotion;
            $promotion->setPrestataire($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): self
    {
        if ($this->promotion->contains($promotion)) {
            $this->promotion->removeElement($promotion);
            // set the owning side to null (unless already changed)
            if ($promotion->getPrestataire() === $this) {
                $promotion->setPrestataire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Stage[]
     */
    public function getStage(): Collection
    {
        return $this->stage;
    }

    public function addStage(Stage $stage): self
    {
        if (!$this->stage->contains($stage)) {
            $this->stage[] = $stage;
            $stage->setPrestataire($this);
        }

        return $this;
    }

    public function removeStage(Stage $stage): self
    {
        if ($this->stage->contains($stage)) {
            $this->stage->removeElement($stage);
            // set the owning side to null (unless already changed)
            if ($stage->getPrestataire() === $this) {
                $stage->setPrestataire(null);
            }
        }

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
            $commentaire->setPrestataire($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaire->contains($commentaire)) {
            $this->commentaire->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getPrestataire() === $this) {
                $commentaire->setPrestataire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(Images $image): self
    {
        if (!$this->image->contains($image)) {
            $this->image[] = $image;
            $image->setPrestataire($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->image->contains($image)) {
            $this->image->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getPrestataire() === $this) {
                $image->setPrestataire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @return Collection|Internaute[]
     */
    public function getInternaute(): Collection
    {
        return $this->internaute;
    }

    public function addInternaute(Internaute $internaute): self
    {
        if (!$this->internaute->contains($internaute)) {
            $this->internaute[] = $internaute;
        }

        return $this;
    }

    public function removeInternaute(Internaute $internaute): self
    {
        if ($this->internaute->contains($internaute)) {
            $this->internaute->removeElement($internaute);
        }

        return $this;
    }
}
