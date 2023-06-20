<?php

namespace App\Entity;

use App\Repository\AnnonceurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[ORM\Entity(repositoryClass: AnnonceurRepository::class)]
class Annonceur extends User
{

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'annonceur', targetEntity: Annonce::class)]
    private Collection $annonces;

    public function __construct()
    {
        $this->annonces = new ArrayCollection();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Annonce>
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces->add($annonce);
            $annonce->setAnnonceur($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getAnnonceur() === $this) {
                $annonce->setAnnonceur(null);
            }
        }

        return $this;
    }

    public function getRoles(): array
    {
        $roles = parent::getRoles();
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_ANNONCEUR';

        return array_unique($roles);
    }
    public function getNbAnnoncesPourvues(): int
    {
        $comptePourvues = 0;
        foreach ($this->annonces as $annonce) {
            if ($annonce->estPourvue()) {
                $comptePourvues++;
            }
        }

        return $comptePourvues;
        // return $this->annonces->filter(function(Annonce $annonce) {
        //     return $annonce->estPourvue();
        // })->count();
    }
}
