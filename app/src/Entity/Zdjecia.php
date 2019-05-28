<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ZdjeciaRepository")
 */
class Zdjecia
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
     * NazwaZdjecia
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $nazwa_zdjecia;

    /**
     * Przepis
     *
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Przepisy", inversedBy="id_zdjecie")
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
     * Getter for NazwaZdjecia
     *
     * @return string|null NazwaZdjecia
     */

    public function getNazwaZdjecia(): ?string
    {
        return $this->nazwa_zdjecia;
    }

    /**
     * Setter for NazwaZdjecia
     *
     * @param string $nazwa_zdjecia NazwaZdjecia
     * @return Zdjecia
     */
    public function setNazwaZdjecia(string $nazwa_zdjecia): self
    {
        $this->nazwa_zdjecia = $nazwa_zdjecia;

        return $this;
    }

    /**
     * Getter for Przepis
     *
     * @return Przepisy|null Przepis
     *
     */
    public function getPrzepis(): ?Przepisy
    {
        return $this->przepis;
    }

    /**
     * Setter for Przepis
     *
     * @param Przepisy|null $przepis Przepis
     * @return Zdjecia
     */
    public function setPrzepis(?Przepisy $przepis): self
    {
        $this->przepis = $przepis;

        return $this;
    }
}
