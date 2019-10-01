<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PositionRepository")
 */
class Position
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ordre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bloc", mappedBy="position")
     */
    private $bloc;

    public function __construct()
    {
        $this->bloc = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Bloc[]
     */
    public function getBloc(): Collection
    {
        return $this->bloc;
    }

    public function addBloc(Bloc $bloc): self
    {
        if (!$this->bloc->contains($bloc)) {
            $this->bloc[] = $bloc;
            $bloc->setPosition($this);
        }

        return $this;
    }

    public function removeBloc(Bloc $bloc): self
    {
        if ($this->bloc->contains($bloc)) {
            $this->bloc->removeElement($bloc);
            // set the owning side to null (unless already changed)
            if ($bloc->getPosition() === $this) {
                $bloc->setPosition(null);
            }
        }

        return $this;
    }
}
