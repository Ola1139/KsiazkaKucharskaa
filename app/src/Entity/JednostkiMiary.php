<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JednostkiMiaryRepository")
 */
class JednostkiMiary
{
    /**
     * Primary key
     *
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * Nazwa jednostki miary
     *
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $nazwa_jednostki_miary;

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
     * Getter for Nazwa Jednostki Miary
     *
     * @return string|null NazwaJednostkiMiary
     */
    public function getNazwaJednostkiMiary(): ?string
    {
        return $this->nazwa_jednostki_miary;
    }

    /**
     * Setter for Nazwa Jednostki Miary
     *
     * @param string $nazwa_jednostki_miary
     * @return JednostkiMiary
     */
    public function setNazwaJednostkiMiary(string $nazwa_jednostki_miary): self
    {
        $this->nazwa_jednostki_miary = $nazwa_jednostki_miary;

        return $this;
    }
}
