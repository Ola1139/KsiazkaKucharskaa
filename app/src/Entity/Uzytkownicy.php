<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UzytkownicyRepository")
 */
class Uzytkownicy
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


    /**
     * Imie
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $imie;

    /**
     * Nazwisko
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $nazwisko;

    /**
     * Zainteresowania
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $zainteresowania;

    /**
     * Ulubiona Kuchnia
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ulubiona_kuchnia;

    /**
     * Ulubiona Potrawa
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ulubiona_potrawa;

    /**
     * O Sobie
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $o_sobie;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Dane", inversedBy="uzytkownicy", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $dane;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Komentarze", mappedBy="autor")
     */
    private $komentarze;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Przepisy", mappedBy="autor")
     */
    private $przepisy;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ulubione", mappedBy="uzytkownik")
     */
    private $ulubione;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Skargi", mappedBy="autor")
     */
    private $skarga;

    public function __construct()
    {
        $this->komentarze = new ArrayCollection();
        $this->przepisy = new ArrayCollection();
        $this->ulubione = new ArrayCollection();
        $this->skarga = new ArrayCollection();
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
     * Getter for Imie
     *
     * @return string|null Imie
     */
    public function getImie(): ?string
    {
        return $this->imie;
    }

    /**
     * Setter for Imie
     * @param string $imie Imie
     * @return Uzytkownicy
     */
    public function setImie(string $imie): self
    {
        $this->imie = $imie;

        return $this;
    }

    /**
     * Getter for Nazwisko
     *
     * @return string|null Nazwisko
     */
    public function getNazwisko(): ?string
    {
        return $this->nazwisko;
    }

    /**
     * Setter for Nazwisko
     *
     * @param string $nazwisko Nazwisko
     * @return Uzytkownicy
     */
    public function setNazwisko(string $nazwisko): self
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    /**
     * Getter for Zainteresowania
     *
     * @return string|null Zainteresowania
     */
    public function getZainteresowania(): ?string
    {
        return $this->zainteresowania;
    }

    /**
     * Setter for Zainteresowania
     *
     * @param string $zainteresowania Zainteresowania
     * @return Uzytkownicy
     */
    public function setZainteresowania(string $zainteresowania): self
    {
        $this->zainteresowania = $zainteresowania;

        return $this;
    }

    /**
     * Getter for UlubionaKuchnia
     * @return string|null UlubionaKuchnia
     */
    public function getUlubionaKuchnia(): ?string
    {
        return $this->ulubiona_kuchnia;
    }

    /**
     * Setter for Ulubiona Kuchnia
     *
     * @param string|null $ulubiona_kuchnia UlubionaKuchnia
     * @return Uzytkownicy
     */
    public function setUlubionaKuchnia(?string $ulubiona_kuchnia): self
    {
        $this->ulubiona_kuchnia = $ulubiona_kuchnia;

        return $this;
    }

    /**
     * Getter for UlubionaPotrawa
     *
     * @return string|null UlubionaPotrawa
     */
    public function getUlubionaPotrawa(): ?string
    {
        return $this->ulubiona_potrawa;
    }

    /**
     * Setter for UlubionaPotrawa
     *
     * @param string|null $ulubiona_potrawa UlubionaPotrawa
     * @return Uzytkownicy
     */
    public function setUlubionaPotrawa(?string $ulubiona_potrawa): self
    {
        $this->ulubiona_potrawa = $ulubiona_potrawa;

        return $this;
    }

    /**
     * Getter for OSobie
     *
     * @return string|null OSobie
     */
    public function getOSobie(): ?string
    {
        return $this->o_sobie;
    }

    /**
     * Setter for OSobie
     *
     * @param string|null $o_sobie OSobie
     * @return Uzytkownicy
     */
    public function setOSobie(?string $o_sobie): self
    {
        $this->o_sobie = $o_sobie;

        return $this;
    }

    /**
     * Getter for Dane
     *
     * @return Dane|null IdDane
     */
    public function getDane(): ?Dane
    {
        return $this->dane;
    }

    /**
     * Setter for Dane
     *
     * @param Dane $dane Dane
     * @return Uzytkownicy
     */
    public function setDane(Dane $dane): self
    {
        $this->dane = $dane;

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
     * @param Komentarze $komentarze
     * @return Uzytkownicy
     */
    public function addKomentarze(Komentarze $komentarze): self
    {
        if (!$this->komentarze->contains($komentarze)) {
            $this->komentarze[] = $komentarze;
            $komentarze->setIdAutor($this);
        }

        return $this;
    }

    /**
     * Remove
     *
     * @param Komentarze $komentarze
     * @return Uzytkownicy
     */
    public function removeKomentarze(Komentarze $komentarze): self
    {
        if ($this->komentarze->contains($komentarze)) {
            $this->komentarze->removeElement($komentarze);
            // set the owning side to null (unless already changed)
            if ($komentarze->getIdAutor() === $this) {
                $komentarze->setIdAutor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Przepisy[]
     */
    public function getPrzepisy(): Collection
    {
        return $this->przepisy;
    }

    /**
     * Add
     *
     * @param Przepisy $przepisy
     * @return Uzytkownicy
     */
    public function addPrzepisy(Przepisy $przepisy): self
    {
        if (!$this->przepisy->contains($przepisy)) {
            $this->przepisy[] = $przepisy;
            $przepisy->setIdAutor($this);
        }

        return $this;
    }

    /**
     * Remove
     *
     * @param Przepisy $przepisy
     * @return Uzytkownicy
     */
    public function removePrzepisy(Przepisy $przepisy): self
    {
        if ($this->przepisy->contains($przepisy)) {
            $this->przepisy->removeElement($przepisy);
            // set the owning side to null (unless already changed)
            if ($przepisy->getIdAutor() === $this) {
                $przepisy->setIdAutor(null);
            }
        }

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
     *
     * @param Ulubione $ulubione
     * @return Uzytkownicy
     */
    public function addUlubione(Ulubione $ulubione): self
    {
        if (!$this->ulubione->contains($ulubione)) {
            $this->ulubione[] = $ulubione;
            $ulubione->setIdUzytkownik($this);
        }

        return $this;
    }

    /**
     * Remove
     *
     * @param Ulubione $ulubione
     * @return Uzytkownicy
     */
    public function removeUlubione(Ulubione $ulubione): self
    {
        if ($this->ulubione->contains($ulubione)) {
            $this->ulubione->removeElement($ulubione);
            // set the owning side to null (unless already changed)
            if ($ulubione->getIdUzytkownik() === $this) {
                $ulubione->setIdUzytkownik(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Skargi[]
     */
    public function getSkarga(): Collection
    {
        return $this->skarga;
    }

    /**
     * Add
     *
     * @param Skargi $skarga
     * @return Uzytkownicy
     */
    public function addSkarga(Skargi $skarga): self
    {
        if (!$this->skarga->contains($skarga)) {
            $this->skarga[] = $skarga;
            $skarga->setIdAutor($this);
        }

        return $this;
    }

    /**
     * Remove
     * @param Skargi $skarga
     * @return Uzytkownicy
     */
    public function removeSkarga(Skargi $skarga): self
    {
        if ($this->skarga->contains($skarga)) {
            $this->skarga->removeElement($skarga);
            // set the owning side to null (unless already changed)
            if ($skarga->getIdAutor() === $this) {
                $skarga->setIdAutor(null);
            }
        }

        return $this;
    }
}
