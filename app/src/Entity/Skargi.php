<?php

namespace App\Entity;

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
    private $id_autor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Przepisy", mappedBy="id_skargi")
     */
    private $id_przepis;

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
     * Getter for IdAutor
     *
     * @return Uzytkownicy|null IdAutor
     */
    public function getIdAutor(): ?Uzytkownicy
    {
        return $this->id_autor;
    }

    /**
     * Setter for IdAutor
     * @param Uzytkownicy|null $id_autor IdAutor
     * @return Skargi
     */
    public function setIdAutor(?Uzytkownicy $id_autor): self
    {
        $this->id_autor = $id_autor;

        return $this;
    }

    /**
     * Getter for IdPrzepis
     *
     * @return Collection|Przepisy[]
     */
    public function getIdPrzepis(): Collection
    {
        return $this->id_przepis;
    }

    /**
     * Add
     *
     * @param Przepisy $idPrzepis
     * @return Skargi
     */
    public function addIdPrzepi(Przepisy $idPrzepis): self
    {
        if (!$this->id_przepis->contains($idPrzepis)) {
            $this->id_przepis[] = $idPrzepis;
            $idPrzepis->setIdSkargi($this);
        }

        return $this;
    }

    /**
     * Remove
     *
     * @param Przepisy $idPrzepis IdPrzepis
     * @return Skargi
     */
    public function removeIdPrzepis(Przepisy $idPrzepis): self
    {
        if ($this->id_przepis->contains($idPrzepis)) {
            $this->id_przepis->removeElement($idPrzepis);
            // set the owning side to null (unless already changed)
            if ($idPrzepis->getIdSkargi() === $this) {
                $idPrzepis->setIdSkargi(null);
            }
        }

        return $this;
    }
}
