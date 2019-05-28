<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Dane
 *
 * @ORM\Entity(repositoryClass="App\Repository\DaneRepository")
 */
class Dane
{
    /**
     * Primary key.
     *
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Email
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * haslo
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $haslo;

    /**
     * Uzytkownicy
     *
     * @var int
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Uzytkownicy", mappedBy="id_dane", cascade={"persist", "remove"})
     */
    private $uzytkownicy;


    /**
     * TypKonta
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $TypKonta;

    /**
     * Getter fo Id
     *
     * @return int|null Id
     */

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for Email
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**Setter for email
     *
     * @param string $email Email
     * @return Dane
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Getter for haslo
     *
     * @return string|null Haslo
     */
    public function getHaslo(): ?string
    {
        return $this->haslo;
    }

    /**
     * Setter for Haslo
     * @param string $haslo Haslo
     * @return Dane
     */
    public function setHaslo(string $haslo): self
    {
        $this->haslo = $haslo;

        return $this;
    }

    /**
     * Getter for uzytkownicy
     *
     * @return Uzytkownicy|null Uzytkownicy
     */
    public function getUzytkownicy(): ?Uzytkownicy
    {
        return $this->uzytkownicy;
    }

    /**
     * Setter for uzytkownicy
     *
     * @param Uzytkownicy $uzytkownicy uzytkownicy
     * @return Dane
     */
    public function setUzytkownicy(Uzytkownicy $uzytkownicy): self
    {
        $this->uzytkownicy = $uzytkownicy;

        // set the owning side of the relation if necessary
        if ($this !== $uzytkownicy->getIdDane()) {
            $uzytkownicy->setIdDane($this);
        }

        return $this;
    }

    /**
     * Getter for TypKonta
     *
     * @return string|null TypKonta
     */
    public function getTypKonta(): ?string
    {
        return $this->TypKonta;
    }

    /**
     * Setter for TypKonta
     * @param string $TypKonta TypKonta
     * @return Dane
     */
    public function setTypKonta(string $TypKonta): self
    {
        $this->TypKonta = $TypKonta;

        return $this;
    }
}
