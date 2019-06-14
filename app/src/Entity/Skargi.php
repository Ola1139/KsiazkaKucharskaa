<?php

namespace App\Entity;

use App\Entity\Przepisy;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SkargiRepository")
 */
class Skargi
{
    /**
     * Primary Key
     *
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**Tresc
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $tresc;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Uzytkownicy", inversedBy="skarga")
     * @ORM\JoinColumn(nullable=false)
     */
    private $autor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Przepisy", inversedBy="skargi")
     * @ORM\JoinColumn(nullable=false)
     */
    private $przepis;

    public function __construct()
    {
        $this->id_przepis = new ArrayCollection();
    }

    /**
     * Getter for Id
     *
     * @return int|null Id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for Tresc
     * @var string
     *
     * @return string|null Tresc
     */

    public function getTresc(): ?string
    {
        return $this->tresc;
    }

    /**Setter for Tresc
     *
     * @param string $tresc Tresc
     * @return Skargi
     */
    public function setTresc(string $tresc): self
    {
        $this->tresc = $tresc;

        return $this;
    }

    /**
     * Getter for Autor
     *
     * @return Uzytkownicy|null Autor
     */
    public function getAutor(): ?Uzytkownicy
    {
        return $this->autor;
    }

    /**
     * Setter for Autor
     * @param Uzytkownicy|null $autor IdAutor
     * @return Skargi
     */
    public function setIdAutor(?Uzytkownicy $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Getter for Przepis
     *
     * @return Collection|Przepisy[]
     */
    public function getPrzepis(): Collection
    {
        return $this->przepis;
    }

    /**
     * Add
     *
     * @param Przepisy $przepisy
     * @return Skargi
     */
    public function addIdPrzepi(Przepisy $przepisy): self
    {
        if (!$this->przepis->contains($przepisy)) {
            $this->przepis[] = $przepisy;
            $przepisy->setSkargi($this);
        }

        return $this;
    }

    /**
     * Remove
     *
     * @param Przepisy $przepisy Przepis
     * @return Skargi
     */
    public function removePrzepis(Przepisy $przepisy): self
    {
        if ($this->przepis->contains($przepisy)) {
            $this->przepis->removeElement($przepisy);
            // set the owning side to null (unless already changed)
            if ($przepisy->getSkargi() === $this) {
                $przepisy->setSkargi(null);
            }
        }

        return $this;
    }
}
