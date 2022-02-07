<?php

namespace App\Entity;

use App\Repository\RateRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: RateRepository::class)]
#[UniqueEntity(fields: ['idObject', 'User'])]
class Rate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2)]
    private $rateNumber;

    #[ORM\Column(type: 'string', length: 255)]
    private $idObject;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'rates')]
    #[ORM\JoinColumn(nullable: false)]
    private $User;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRateNumber(): ?string
    {
        return $this->rateNumber;
    }

    public function setRateNumber(string $rateNumber): self
    {
        $this->rateNumber = $rateNumber;

        return $this;
    }


    public function getIdObject(): ?string
    {
        return $this->idObject;
    }

    public function setIdObject(string $idObject): self
    {
        $this->idObject = $idObject;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }
}
