<?php

namespace App\Form\Filtre;

use App\Entity\Race;

class FiltreAnnonce
{
  protected ?Race $race = null;
  protected bool $isLof = false;

    public function getRace(): ?Race {
        return $this->race;
    }

    public function setRace(?Race $race): self {
        $this->race = $race;
        return $this;
    }

    public function getIsLof(): bool {
        return $this->isLof;
    }

    public function setIsLof(bool $isLof): self {
        $this->isLof = $isLof;
        return $this;
    }
}