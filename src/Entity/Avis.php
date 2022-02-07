<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titreAvis;

    #[ORM\Column(type: 'text')]
    private $avisText;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'avis')]
    #[ORM\JoinColumn(nullable: false)]
    private $idUser;

    #[ORM\Column(type: 'string', length: 255)]
    private $idSorage;

    #[ORM\Column(type: 'date')]
    private $dateAvis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreAvis(): ?string
    {
        return $this->titreAvis;
    }

    public function setTitreAvis(string $titreAvis): self
    {
        $this->titreAvis = $titreAvis;

        return $this;
    }

    public function getAvisText(): ?string
    {
        return $this->avisText;
    }

    public function setAvisText(string $avisText): self
    {
        $this->avisText = $avisText;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdSorage(): ?string
    {
        return $this->idSorage;
    }

    public function setIdSorage(string $idSorage): self
    {
        $this->idSorage = $idSorage;

        return $this;
    }

    public function getDateAvis(): ?\DateTimeInterface
    {
        return $this->dateAvis;
    }

    public function setDateAvis(\DateTimeInterface $dateAvis): self
    {
        $this->dateAvis = $dateAvis;

        return $this;
    }
}
