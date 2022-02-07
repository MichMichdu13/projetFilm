<?php

namespace App\Entity;

use App\Repository\RateListeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: RateListeRepository::class)]
#[UniqueEntity(fields: ['IdFilm'])]
class RateListe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $IdFilm;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2)]
    private $MoyenneRate;

    #[ORM\Column(type: 'text')]
    private $img;

    #[ORM\Column(type: 'string', length: 255)]
    private $nameFilm;

    #[ORM\Column(type: 'string', length: 255)]
    private $Type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdFilm(): ?string
    {
        return $this->IdFilm;
    }

    public function setIdFilm(string $IdFilm): self
    {
        $this->IdFilm = $IdFilm;

        return $this;
    }

    public function getMoyenneRate(): ?float
    {
        return $this->MoyenneRate;
    }

    public function setMoyenneRate(float $MoyenneRate): self
    {
        $this->MoyenneRate = $MoyenneRate;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getNameFilm(): ?string
    {
        return $this->nameFilm;
    }

    public function setNameFilm(string $nameFilm): self
    {
        $this->nameFilm = $nameFilm;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }
}
