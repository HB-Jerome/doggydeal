<?php

namespace App\Entity;

use App\Repository\AdoptionOfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdoptionOfferRepository::class)]
class AdoptionOffer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreatedAt = null;

    #[ORM\Column]
    private ?bool $isAccepted = null;

    #[ORM\ManyToOne(inversedBy: 'adoptionOffers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Annonce $Annonce = null;

    #[ORM\ManyToMany(targetEntity: Dog::class, inversedBy: 'adoptionOffers')]
    private Collection $dogs;

    #[ORM\OneToMany(mappedBy: 'AdoptionOffer', targetEntity: Message::class)]
    private Collection $messages;

    #[ORM\ManyToOne(inversedBy: 'adoptionOffers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adoptant $adoptants = null;

    public function __construct()
    {
        $this->dogs = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function isIsAccepted(): ?bool
    {
        return $this->isAccepted;
    }

    public function setIsAccepted(bool $isAccepted): self
    {
        $this->isAccepted = $isAccepted;

        return $this;
    }

    public function getAnnonce(): ?Annonce
    {
        return $this->Annonce;
    }

    public function setAnnonce(?Annonce $Annonce): self
    {
        $this->Annonce = $Annonce;

        return $this;
    }

    /**
     * @return Collection<int, Dog>
     */
    public function getDogs(): Collection
    {
        return $this->dogs;
    }

    public function addDog(Dog $dog): self
    {
        if (!$this->dogs->contains($dog)) {
            $this->dogs->add($dog);
        }

        return $this;
    }

    public function removeDog(Dog $dog): self
    {
        $this->dogs->removeElement($dog);

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setAdoptionOffer($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getAdoptionOffer() === $this) {
                $message->setAdoptionOffer(null);
            }
        }

        return $this;
    }

    public function getAdoptants(): ?Adoptant
    {
        return $this->adoptants;
    }

    public function setAdoptants(?Adoptant $adoptants): self
    {
        $this->adoptants = $adoptants;

        return $this;
    }
}
