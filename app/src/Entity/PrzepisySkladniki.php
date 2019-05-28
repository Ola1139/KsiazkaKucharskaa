<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrzepisySkladnikiRepository")
 */
class PrzepisySkladniki
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $IloscSkladnika;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIloscSkladnika(): ?int
    {
        return $this->IloscSkladnika;
    }

    public function setIloscSkladnika(int $IloscSkladnika): self
    {
        $this->IloscSkladnika = $IloscSkladnika;

        return $this;
    }
}
