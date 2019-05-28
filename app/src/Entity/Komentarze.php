<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KomentarzeRepository")
 */
class Komentarze
{
    /**
     * Primary key
     *
     * @var int
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
     * Ocena
     *
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $ocena;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Uzytkownicy", inversedBy="komentarze")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_autor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Przepisy", inversedBy="id_komentarze")
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
     * Getter for Tresc
     *
     *
     * @return string|null Tresc
     */

    public function getTresc(): ?string
    {
        return $this->tresc;
    }

    /**
     * Setter for tresc
     *
     * @param string $tresc Tresc
     * @return Komentarze
     */

    public function setTresc(string $tresc): self
    {
        $this->tresc = $tresc;

        return $this;
    }

    /**
     * Getter for ocena
     *
     * @return int|null Ocena
     */

    public function getOcena(): ?int
    {
        return $this->ocena;
    }

    /**
     * Setter for Ocena
     *
     * @param int $ocena Ocena
     * @return Komentarze
     */
    public function setOcena(int $ocena): self
    {
        $this->ocena = $ocena;

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
     *
     * @param Uzytkownicy|null $id_autor IdAutor
     * @return Komentarze
     */
    public function setIdAutor(?Uzytkownicy $id_autor): self
    {
        $this->id_autor = $id_autor;

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
     * @return Komentarze
     */
    public function setPrzepis(?Przepisy $przepis): self
    {
        $this->przepis = $przepis;

        return $this;
    }
}
