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
     */
    private $tresc;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Uzytkownicy", inversedBy="przepisy")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_autor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ulubione", mappedBy="id_przepis")
     */
    private $ulubione;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Skargi", inversedBy="id_przepis")
     */
    private $id_skargi;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Komentarze", mappedBy="przepis")
     */
    private $id_komentarze;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Zdjecia", mappedBy="przepis")
     */
    private $id_zdjecie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Kategorie", mappedBy="przepis")
     */
    private $kategoria;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PrzepisySkladniki", mappedBy="Przepis", fetch="EXTRA_LAZY")
     */
    private $id_skladnik;

    public function __construct()
    {
        $this->ulubione = new ArrayCollection();
        $this->id_komentarze = new ArrayCollection();
        $this->id_zdjecie = new ArrayCollection();
        $this->kategoria = new ArrayCollection();
        $this->id_skladnik = new ArrayCollection();
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
     * @param string $tresc Tresc
     * @return Przepisy
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
     * @return Przepisy
     */
    public function setIdAutor(?Uzytkownicy $id_autor): self
    {
        $this->id_autor = $id_autor;

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
            $ulubione->setIdPrzepis($this);
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
            if ($ulubione->getIdPrzepis() === $this) {
                $ulubione->setIdPrzepis(null);
            }
        }

        return $this;
    }

    /**
     * Getter for IdSkargi
     *
     * @return Skargi|null IdSkargi
     */
    public function getIdSkargi(): ?Skargi
    {
        return $this->id_skargi;
    }

    /**
     * Setter dor IdSkargi
     *
     * @param Skargi|null $id_skargi IdSkargi
     * @return Przepisy
     */
    public function setIdSkargi(?Skargi $id_skargi): self
    {
        $this->id_skargi = $id_skargi;

        return $this;
    }

    /**
     * @return Collection|Komentarze[]
     */
    public function getIdKomentarze(): Collection
    {
        return $this->id_komentarze;
    }

    /**
     * Add
     *
     * @param Komentarze $idKomentarze IdKomentarze
     * @return Przepisy
     */
    public function addIdKomentarze(Komentarze $idKomentarze): self
    {
        if (!$this->id_komentarze->contains($idKomentarze)) {
            $this->id_komentarze[] = $idKomentarze;
            $idKomentarze->setPrzepis($this);
        }

        return $this;
    }

    /**
     * Remove
     *
     * @param Komentarze $idKomentarze IdKomentarze
     * @return Przepisy
     */
    public function removeIdKomentarze(Komentarze $idKomentarze): self
    {
        if ($this->id_komentarze->contains($idKomentarze)) {
            $this->id_komentarze->removeElement($idKomentarze);
            // set the owning side to null (unless already changed)
            if ($idKomentarze->getPrzepis() === $this) {
                $idKomentarze->setPrzepis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Zdjecia[]
     */
    public function getIdZdjecie(): Collection
    {
        return $this->id_zdjecie;
    }

    /**
     * Add
     * @param Zdjecia $idZdjecie IdZdjecie
     * @return Przepisy
     */
    public function addIdZdjecie(Zdjecia $idZdjecie): self
    {
        if (!$this->id_zdjecie->contains($idZdjecie)) {
            $this->id_zdjecie[] = $idZdjecie;
            $idZdjecie->setPrzepis($this);
        }

        return $this;
    }

    /**
     * Remove
     *
     * @param Zdjecia $idZdjecie IdZdjecie
     * @return Przepisy
     */
    public function removeIdZdjecie(Zdjecia $idZdjecie): self
    {
        if ($this->id_zdjecie->contains($idZdjecie)) {
            $this->id_zdjecie->removeElement($idZdjecie);
            // set the owning side to null (unless already changed)
            if ($idZdjecie->getPrzepis() === $this) {
                $idZdjecie->setPrzepis(null);
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
    public function getIdSkladnik(): Collection
    {
        return $this->id_skladnik;
    }

    /**
     * Add
     *
     * @param Skladniki $idSkladnik IdSkladnik
     * @return Przepisy
     */
    public function addIdSkladnik(Skladniki $idSkladnik): self
    {
        if (!$this->id_skladnik->contains($idSkladnik)) {
            $this->id_skladnik[] = $idSkladnik;
        }

        return $this;
    }

    /**
     * Remove
     *
     * @param Skladniki $idSkladnik IdSkladnik
     * @return Przepisy
     */
    public function removeIdSkladnik(Skladniki $idSkladnik): self
    {
        if ($this->id_skladnik->contains($idSkladnik)) {
            $this->id_skladnik->removeElement($idSkladnik);
        }

        return $this;
    }


}
