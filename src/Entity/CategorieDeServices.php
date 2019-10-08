<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieDeServicesRepository")
 */
class CategorieDeServices
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
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $enAvant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $valide;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Prestataire", mappedBy="categorieDeServices")
     */
    private $prestataires;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Promotion", mappedBy="categorieDeServices")
     */
    private $promotion;

    public function __construct()
    {
        $this->prestataires = new ArrayCollection();
        $this->promotion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEnAvant(): ?bool
    {
        return $this->enAvant;
    }

    public function setEnAvant(?bool $enAvant): self
    {
        $this->enAvant = $enAvant;

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

    public function getValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(?bool $valide): self
    {
        $this->valide = $valide;

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
            $prestataire->addCategorieDeService($this);
        }

        return $this;
    }

    public function removePrestataire(Prestataire $prestataire): self
    {
        if ($this->prestataires->contains($prestataire)) {
            $this->prestataires->removeElement($prestataire);
            $prestataire->removeCategorieDeService($this);
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
            $promotion->setCategorieDeServices($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): self
    {
        if ($this->promotion->contains($promotion)) {
            $this->promotion->removeElement($promotion);
            // set the owning side to null (unless already changed)
            if ($promotion->getCategorieDeServices() === $this) {
                $promotion->setCategorieDeServices(null);
            }
        }

        return $this;
    }
}
