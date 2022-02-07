<?php

namespace App\Entity;

use App\Repository\FavActeursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: FavActeursRepository::class)]
#[UniqueEntity(fields: ['idActeur', 'UserId'])]
class FavActeurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $idActeur;

    #[ORM\Column(type: 'string', length: 255)]
    private $imageActeur;

    #[ORM\Column(type: 'string', length: 255)]
    private $nameActeur;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'favActeurs')]
    #[ORM\JoinColumn(nullable: false)]
    private $UserId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdActeur(): ?string
    {
        return $this->idActeur;
    }

    public function setIdActeur(string $idActeur): self
    {
        $this->idActeur = $idActeur;

        return $this;
    }

    public function getImageActeur(): ?string
    {
        return $this->imageActeur;
    }

    public function setImageActeur(string $imageActeur): self
    {
        $this->imageActeur = $imageActeur;

        return $this;
    }

    public function getNameActeur(): ?string
    {
        return $this->nameActeur;
    }

    public function setNameActeur(string $nameActeur): self
    {
        $this->nameActeur = $nameActeur;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->UserId;
    }

    public function setUserId(?User $UserId): self
    {
        $this->UserId = $UserId;

        return $this;
    }


}
