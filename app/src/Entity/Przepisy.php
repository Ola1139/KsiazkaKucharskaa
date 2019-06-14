<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrzepisyRepository")
 */
class Przepisy
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     *
     * @constant int NUMBER_OF_ITEMS
     */
    const NUMBER_OF_ITEMS = 10;

    /**
     * Primary key
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * Tresc
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     *
     */
    private $tresc;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Uzytkownicy", inversedBy="przepisy")
     * @ORM\JoinColumn(nullable=false)
     */
    private $autor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ulubione", mappedBy="przepis")
     */
    private $ulubione;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Skargi", mappedBy="przepis")
     */
    private $skargi;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Komentarze", mappedBy="przepis")
     */
    private $komentarze;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Zdjecia", mappedBy="przepis")
     */
    private $zdjecie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Kategorie", inversedBy="przepis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $kategoria;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PrzepisySkladniki", mappedBy="przepis", fetch="EXTRA_LAZY")
     */
    private $skladnik;

    public function __construct()
    {
        $this->ulubione = new ArrayCollection();
        $this->komentarze = new ArrayCollection();
        $this->zdjecie = new ArrayCollection();
        $this->kategoria = new ArrayCollection();
        $this->skladnik = new ArrayCollection();
    }

    /**
     *Getter for Id
     *
     * @return int|null Id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**Getter for Tresc
     *
     * @return string|null Tresc
     */

    public function getTresc(): ?string
    {
        return $this->tresc;
    }

    /**Setter for Tresc
     *
     *  @param Przepisy|null $tresc Tresc
     * @return Przepisy
     */
    public function setTresc(?Przepisy $tresc): self
    {
        $this->tresc = $tresc;

        return $this;
    }

    /**
     * Getter for Autor
     *
     * @return Uzytkownicy|null autor
     */
    public function getAutor(): ?Uzytkownicy
    {
        return $this->autor;
    }

    /**
     * Setter for Autor
     * @param Uzytkownicy|null $autor Autor
     * @return Przepisy
     */
    public function setAutor(?Uzytkownicy $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * @return Collection|Ulubione[]
     */
    public function getUlubione(): Collection
    {
        return $this->ulubione;
    }

    /**
     * Add
     * @param Ulubione $ulubione Ulubione
     * @return Przepisy
     */
    public function addUlubione(Ulubione $ulubione): self
    {
        if (!$this->ulubione->contains($ulubione)) {
            $this->ulubione[] = $ulubione;
            $ulubione->setPrzepis($this);
        }

        return $this;
    }

    /**
     * Remove
     *
     * @param Ulubione $ulubione Ulubione
     * @return Przepisy
     */
    public function removeUlubione(Ulubione $ulubione): self
    {
        if ($this->ulubione->contains($ulubione)) {
            $this->ulubione->removeElement($ulubione);
            // set the owning side to null (unless already changed)
            if ($ulubione->getPrzepis() === $this) {
                $ulubione->setPrzepis(null);
            }
        }

        return $this;
    }

    /**
     * Getter for Skargi
     *
     * @return Skargi|null Skargi
     */
    public function getSkargi(): ?Skargi
    {
        return $this->skargi;
    }

    /**
     * Setter dor Skargi
     *
     * @param Skargi|null $skargi Skargi
     * @return Przepisy
     */
    public function setSkargi(?Skargi $skargi): self
    {
        $this->skargi = $skargi;

        return $this;
    }

    /**
     * @return Collection|Komentarze[]
     */
    public function getKomentarze(): Collection
    {
        return $this->komentarze;
    }

    /**
     * Add
     *
     * @param Komentarze $Komentarze Komentarze
     * @return Przepisy
     */
    public function addKomentarze(Komentarze $Komentarze): self
    {
        if (!$this->komentarze->contains($Komentarze)) {
            $this->komentarze[] = $Komentarze;
            $Komentarze->setPrzepis($this);
        }

        return $this;
    }

    /**
     * Remove
     *
     * @param Komentarze $Komentarze Komentarze
     * @return Przepisy
     */
    public function removeKomentarze(Komentarze $Komentarze): self
    {
        if ($this->komentarze->contains($Komentarze)) {
            $this->komentarze->removeElement($Komentarze);
            // set the owning side to null (unless already changed)
            if ($Komentarze->getPrzepis() === $this) {
                $Komentarze->setPrzepis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Zdjecia[]
     */
    public function getZdjecie(): Collection
    {
        return $this->zdjecie;
    }

    /**
     * Add
     * @param Zdjecia $Zdjecie IdZdjecie
     * @return Przepisy
     */
    public function addZdjecie(Zdjecia $Zdjecie): self
    {
        if (!$this->zdjecie->contains($Zdjecie)) {
            $this->zdjecie[] = $Zdjecie;
            $Zdjecie->setPrzepis($this);
        }

        return $this;
    }

    /**
     * Remove
     *
     * @param Zdjecia $Zdjecie Zdjecie
     * @return Przepisy
     */
    public function removeZdjecie(Zdjecia $Zdjecie): self
    {
        if ($this->zdjecie->contains($Zdjecie)) {
            $this->zdjecie->removeElement($Zdjecie);
            // set the owning side to null (unless already changed)
            if ($Zdjecie->getPrzepis() === $this) {
                $Zdjecie->setPrzepis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Kategorie[]
     */
    public function getKategoria(): Collection
    {
        return $this->kategoria;
    }

    /**
     * Add
     *
     * @param Kategorie $kategorie Kategorie
     * @return Przepisy
     */
    public function addKategorie(Kategorie $kategorie): self
    {
        if (!$this->kategoria->contains($kategorie)) {
            $this->kategoria[] = $kategorie;
            $kategorie->setPrzepis($this);
        }

        return $this;
    }

    /**
     * Remove
     *
     * @param Kategorie $kategorie Kategorie
     * @return Przepisy
     */
    public function removeKategorie(Kategorie $kategorie): self
    {
        if ($this->kategoria->contains($kategorie)) {
            $this->kategoria->removeElement($kategorie);
            // set the owning side to null (unless already changed)
            if ($kategorie->getPrzepis() === $this) {
                $kategorie->setPrzepis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Skladniki[]
     */
    public function getSkladnik(): Collection
    {
        return $this->skladnik;
    }

    /**
     * Add
     *
     * @param Skladniki $Skladnik Skladnik
     * @return Przepisy
     */
    public function addSkladnik(Skladniki $Skladnik): self
    {
        if (!$this->skladnik->contains($Skladnik)) {
            $this->skladnik[] = $Skladnik;
        }

        return $this;
    }

    /**
     * Remove
     *
     * @param Skladniki $Skladnik Skladnik
     * @return Przepisy
     */
    public function removeSkladnik(Skladniki $Skladnik): self
    {
        if ($this->skladnik->contains($Skladnik)) {
            $this->skladnik->removeElement($Skladnik);
        }

        return $this;
    }


}
