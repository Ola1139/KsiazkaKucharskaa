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
    private $nazwaJednostkiMiary;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PrzepisySkladniki", mappedBy="jednostkaMiary")
     */
    private $jednostkaMiary;

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
        return $this->nazwaJednostkiMiary;
    }

    /**
     * Setter for Nazwa Jednostki Miary
     *
     * @param string $nazwaJednostkiMiary
     * @return JednostkiMiary
     */
    public function setNazwaJednostkiMiary(string $nazwaJednostkiMiary): self
    {
        $this->nazwaJednostkiMiary = $nazwaJednostkiMiary;

        return $this;
    }

    public function getJednostkaMiary(): ?PrzepisySkladniki
    {
        return $this->JednostkaMiary;
    }

    public function setJednostkaMiary(?PrzepisySkladniki $JednostkaMiary): self
    {
        $this->JednostkaMiary = $JednostkaMiary;

        return $this;
    }
}
