<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Dane
 *
 * @ORM\Entity(repositoryClass="App\Repository\DaneRepository")
 *
 *
 */
class Dane implements UserInterface
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     *
     * @constant int NUMBER_OF_ITEMS
     */
    const NUMBER_OF_ITEMS = 3;

    /**
     * Konto zwyklego uzytkownika.
     *
     * @var string
     */
    const ROLE_USER = 'ROLE_USER';

    /**
     * Konto admina.
     *
     * @var string
     */
    const ROLE_ADMIN = 'ROLE_ADMIN';

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
     * Haslo.
     *
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *     min="3",
     *     max="255",
     * )
     *
     * @SecurityAssert\UserPassword
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
     * @ORM\Column(type="string")
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
    public function getPassword(): ?string
    {
        return $this->haslo;
    }

    /**
     * Setter for Haslo
     * @param string $haslo Haslo
     * @return Dane
     */
    public function setPassword(string $haslo): self
    {
        $this->haslo = $haslo;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using bcrypt or argon
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
     * Getter for the TypKonta.
     *
     * @return string TypKonta
     */
    public function getRoles() : string
    {
        $TypKonta = $this->TypKonta;
        // guarantee every user at least has ROLE_USER
        $TypKonta[] = static::ROLE_USER;

        return $TypKonta;
    }

    /**
     * Setter for the TypKonta.
     *
     * @param string $TypKonta TypKonta
     */
    public function setRoles(string $TypKonta): void
    {
        $this->TypKonta = $TypKonta;
    }

    /**
     * {@inheritdoc}
     *
     * @see UserInterface
     *
     * @return string User name
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

}
