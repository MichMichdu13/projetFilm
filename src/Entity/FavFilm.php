<?php

namespace App\Entity;

use App\Repository\FavFilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: FavFilmRepository::class)]
#[UniqueEntity(fields: ['id_film', 'UserId'])]
class FavFilm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $id_film;

    #[ORM\Column(type: 'string', length: 255)]
    private $imgFilm;

    #[ORM\Column(type: 'string', length: 255)]
    private $titreFilm;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'favFilms')]
    #[ORM\JoinColumn(nullable: false)]
    private $UserId;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdFilm(): ?string
    {
        return $this->id_film;
    }

    public function setIdFilm(string $id_film): self
    {
        $this->id_film = $id_film;

        return $this;
    }

    public function getImgFilm(): ?string
    {
        return $this->imgFilm;
    }

    public function setImgFilm(string $imgFilm): self
    {
        $this->imgFilm = $imgFilm;

        return $this;
    }

    public function getTitreFilm(): ?string
    {
        return $this->titreFilm;
    }

    public function setTitreFilm(string $titreFilm): self
    {
        $this->titreFilm = $titreFilm;

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
