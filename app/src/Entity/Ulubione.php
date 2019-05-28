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
    private $id_uzytkownik;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Przepisy", inversedBy="ulubione")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_przepis;

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
     * Getter for IdUzytkownik
     *
     * @return Uzytkownicy|null IdUzytkownik
     */
    public function getIdUzytkownik(): ?Uzytkownicy
    {
        return $this->id_uzytkownik;
    }

    /**
     * Setter for IdUzytkownik
     *
     * @param Uzytkownicy|null $id_uzytkownik IdUzytkownik
     * @return Ulubione
     */
    public function setIdUzytkownik(?Uzytkownicy $id_uzytkownik): self
    {
        $this->id_uzytkownik = $id_uzytkownik;

        return $this;
    }

    /**
     *Getter for IdPrzepis
     *
     * @return Przepisy|null przepis
     */
    public function getIdPrzepis(): ?Przepisy
    {
        return $this->id_przepis;
    }

    /**
     * Setter for IdPrzepis
     *
     * @param Przepisy|null $id_przepis IdPrzepis
     * @return Ulubione
     */
    public function setIdPrzepis(?Przepisy $id_przepis): self
    {
        $this->id_przepis = $id_przepis;

        return $this;
    }


}
