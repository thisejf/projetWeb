<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewsLetterRepository")
 */
class NewsLetter
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
    private $documentPDF;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $publication;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDocumentPDF()
    {
        return $this->documentPDF;
    }

    public function setDocumentPDF($documentPDF): self
    {
        $this->documentPDF = $documentPDF;

        return $this;
    }

    public function getPublication(): ?\DateTimeInterface
    {
        return $this->publication;
    }

    public function setPublication(?\DateTimeInterface $publication): self
    {
        $this->publication = $publication;

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
}
