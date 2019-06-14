<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KategorieRepository")
 */
class Kategorie
{

    /** Primary key
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $nazwa_kategorii;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Przepisy", mappedBy="kategoria")
     */
    private $przepis;

    /**
     * Getter for Id
     * @return int|null Id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for NazwaKategorii
     *
     * @return string|null NazwaKategorii
     */
    public function getNazwaKategorii(): ?string
    {
        return $this->nazwa_kategorii;
    }

    /**
     * Setter for NazwaKategorii
     *
     * @param string $nazwa_kategorii NazwaKategorii
     * @return Kategorie
     */
    public function setNazwaKategorii(string $nazwa_kategorii): self
    {
        $this->nazwa_kategorii = $nazwa_kategorii;

        return $this;
    }

    /**
     * Getter for Przepisy
     *
     * @return Przepisy|null Przepisy
     */
    public function getPrzepis(): ?Przepisy
    {
        return $this->przepis;
    }

    /**
     * Setter for Przepisy
     *
     * @param Przepisy|null $przepis Przepisy
     * @return Kategorie
     */
    public function setPrzepis(?Przepisy $przepis): self
    {
        $this->przepis = $przepis;

        return $this;
    }
}
