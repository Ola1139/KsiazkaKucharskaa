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
     * Tytul
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     *
     */
    private $tytul;

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
     * @ORM\OneToMany(targetEntity="App\Entity\Ulubione", mappedBy="przepis",  orphanRemoval=true)
     */
    private $ulubione;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Skargi", mappedBy="przepis",  orphanRemoval=true)
     */
    private $skargi;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Komentarze", mappedBy="przepis",  orphanRemoval=true)
     */
    private $komentarze;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Zdjecia", mappedBy="przepis",  orphanRemoval=true)
     */
    private $zdjecie;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Kategorie", inversedBy="przepis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $kategoria;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PrzepisySkladniki", mappedBy="przepis",  orphanRemoval=true)
     */
    private $skladnik;

    public function __construct()
    {
        $this->ulubione = new ArrayCollection();
        $this->komentarze = new ArrayCollection();
        $this->autor= new ArrayCollection();
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

    /**
     * Getter for Tresc
     *
     * @return string|null tresc
     */

    public function getTresc(): ?string
    {
        return $this->tresc;
    }

    /**
     * Setter for tresc
     *
     * @param string $tresc Tresc
     * @return Przepisy
     */
    public function setTresc(?string $tresc): self
    {
        $this->tresc = $tresc;

        return $this;
    }
    /**
     * Getter for Tytul
     *
     * @return string|null tytul
     */

    public function getTytul(): ?string
    {
        return $this->tytul;
    }

    /**
     * Setter for tytul
     *
     * @param string $tytul Tytul
     * @return Przepisy
     */
    public function setTytul(?string $tytul): self
    {
        $this->tytul = $tytul;

        return $this;
    }
    /**
     * Getter for Autor
     *
     *
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Setter for Autor
     *
     * @return Przepisy
     */
    public function setAutor($autor): self
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
     *
     */
    public function getKategoria()
    {
        return $this->kategoria;
    }

    /**
     * Setter do Kategorie
     *
     * @param Kategorie|null $kategorie Kategorie
     * @return Przepisy
     */
    public function setKategoria(?Kategorie $kategorie): self
    {
        $this->kategoria = $kategorie;
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
