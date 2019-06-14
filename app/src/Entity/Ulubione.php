<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UlubioneRepository")
 */
class Ulubione
{
    /**
     * Primary Key
     *
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Uzytkownicy", inversedBy="ulubione")
     * @ORM\JoinColumn(nullable=false)
     */
    private $uzytkownik;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Przepisy", inversedBy="ulubione")
     * @ORM\JoinColumn(nullable=false)
     */
    private $przepis;

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
     * Getter for Uzytkownik
     *
     * @return Uzytkownicy|null Uzytkownik
     */
    public function getUzytkownik(): ?Uzytkownicy
    {
        return $this->uzytkownik;
    }

    /**
     * Setter for Uzytkownik
     *
     * @param Uzytkownicy|null $uzytkownik Uzytkownik
     * @return Ulubione
     */
    public function setUzytkownik(?Uzytkownicy $uzytkownik): self
    {
        $this->uzytkownik = $uzytkownik;

        return $this;
    }

    /**
     *Getter for Przepis
     *
     * @return Przepisy|null przepis
     */
    public function getPrzepis(): ?Przepisy
    {
        return $this->przepis;
    }

    /**
     * Setter for Przepis
     *
     * @param Przepisy|null $id_przepis Przepis
     * @return Ulubione
     */
    public function setPrzepis(?Przepisy $id_przepis): self
    {
        $this->przepis = $id_przepis;

        return $this;
    }


}
