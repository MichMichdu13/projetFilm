<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    private $FirstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $LastName;

    #[ORM\Column(type: 'text')]
    private $imgProfil;

    #[ORM\OneToMany(mappedBy: 'UserId', targetEntity: FavActeurs::class)]
    private $favActeurs;

    #[ORM\OneToMany(mappedBy: 'UserIs', targetEntity: FavFilm::class)]
    private $favFilms;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: Avis::class)]
    private $avis;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Rate::class)]
    private $rates;


    public function __construct()
    {
        $this->favFilms = new ArrayCollection();
        $this->favActeurs = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->rates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getImgProfil(): ?string
    {
        return $this->imgProfil;
    }

    public function setImgProfil(string $imgProfil): self
    {
        $this->imgProfil = $imgProfil;

        return $this;
    }

    /**
     * @return Collection|FavActeurs[]
     */
    public function getFavActeurs(): Collection
    {
        return $this->favActeurs;
    }

    public function addFavActeur(FavActeurs $favActeur): self
    {
        if (!$this->favActeurs->contains($favActeur)) {
            $this->favActeurs[] = $favActeur;
            $favActeur->setUserId($this);
        }

        return $this;
    }

    public function removeFavActeur(FavActeurs $favActeur): self
    {
        if ($this->favActeurs->removeElement($favActeur)) {
            // set the owning side to null (unless already changed)
            if ($favActeur->getUserId() === $this) {
                $favActeur->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FavFilm[]
     */
    public function getFavFilms(): Collection
    {
        return $this->favFilms;
    }

    public function addFavFilm(FavFilm $favFilm): self
    {
        if (!$this->favFilms->contains($favFilm)) {
            $this->favFilms[] = $favFilm;
            $favFilm->setUserIs($this);
        }

        return $this;
    }

    public function removeFavFilm(FavFilm $favFilm): self
    {
        if ($this->favFilms->removeElement($favFilm)) {
            // set the owning side to null (unless already changed)
            if ($favFilm->getUserIs() === $this) {
                $favFilm->setUserIs(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Avis[]
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setIdUser($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getIdUser() === $this) {
                $avi->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rate[]
     */
    public function getRates(): Collection
    {
        return $this->rates;
    }

    public function addRate(Rate $rate): self
    {
        if (!$this->rates->contains($rate)) {
            $this->rates[] = $rate;
            $rate->setUser($this);
        }

        return $this;
    }

    public function removeRate(Rate $rate): self
    {
        if ($this->rates->removeElement($rate)) {
            // set the owning side to null (unless already changed)
            if ($rate->getUser() === $this) {
                $rate->setUser(null);
            }
        }

        return $this;
    }


}
