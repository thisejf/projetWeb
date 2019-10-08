<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImagesRepository")
 */
class Images
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
    private $image;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ordre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prestataire", inversedBy="image")
     */
    private $prestataire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prestataire", inversedBy="images")
     */
    private $prestatairePhotos;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CategorieDeServices", cascade={"persist", "remove"})
     */
    private $categorieDeServices;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(?int $ordre): self
    {
        $this->ordre = $ordre;

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

    public function getPrestatairePhotos(): ?Prestataire
    {
        return $this->prestatairePhotos;
    }

    public function setPrestatairePhotos(?Prestataire $prestatairePhotos): self
    {
        $this->prestatairePhotos = $prestatairePhotos;

        return $this;
    }

    public function getCategorieDeServices(): ?CategorieDeServices
    {
        return $this->categorieDeServices;
    }

    public function setCategorieDeServices(?CategorieDeServices $categorieDeServices): self
    {
        $this->categorieDeServices = $categorieDeServices;

        return $this;
    }
}
