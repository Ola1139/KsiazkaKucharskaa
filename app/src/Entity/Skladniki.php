<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SkladnikiRepository")
 */
class Skladniki
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
     * Nazwa
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $nazwa;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PrzepisySkladniki", mappedBy="skladnik",  orphanRemoval=true)
     */
    private $przepisy;

    public function __construct()
    {
        $this->przepisy = new ArrayCollection();
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
     * Getter for Nazwa
     *
     * @return string|null Nazwa
     */
    public function getNazwa(): ?string
    {
        return $this->nazwa;
    }

    /**
     * Setter for Nazwa
     * @param string $nazwa Nazwa
     * @return Skladniki
     */
    public function setNazwa(string $nazwa): self
    {
        $this->nazwa = $nazwa;

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
     * @param Przepisy $przepisy Przepis
     * @return Skladniki
     */
    public function addPrzepisy(Przepisy $przepisy): self
    {
        if (!$this->przepisy->contains($przepisy)) {
            $this->przepisy[] = $przepisy;
            $przepisy->addSkladnik($this);
        }

        return $this;
    }

    /**
     * Remove
     *
     * @param Przepisy $przepisy Przepis
     * @return Skladniki
     */
    public function removePrzepisy(Przepisy $przepisy): self
    {
        if ($this->przepisy->contains($przepisy)) {
            $this->przepisy->removeElement($przepisy);
            // set the owning side to null (unless already changed)
            if ($przepisy->getSkladnik() === $this) {
                $przepisy->addSkladnik(null);
            }
        }

        return $this;
    }
}
