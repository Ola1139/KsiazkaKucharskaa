<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\PropertyAccess\PropertyAccess;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrzepisySkladnikiRepository")
 *  @ORM\Table(name="przepisy_skladniki")
 */
class PrzepisySkladniki
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * Przepis
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Przepisy", inversedBy="skladnik")
     * @ORM\JoinColumn(nullable=false)
     */
    private $przepis;

    /**
     * Skladnik
     *
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Skladniki", inversedBy="przepisy")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skladnik;

    /**
     * Ilosc skladnika
     *
     * @ORM\Column(type="integer")
     */
    private $iloscSkladnika;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\JednostkiMiary", inversedBy="jednostkaMiary")
     * @ORM\JoinColumn(nullable=false)
     */
    private $jednostkaMiary;

    public function __construct()
    {
        $this->JednostkaMiary = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIloscSkladnika(): ?int
    {
        return $this->iloscSkladnika;
    }

    public function setIloscSkladnika(int $iloscSkladnika): self
    {
        $this->iloscSkladnika = $iloscSkladnika;

        return $this;
    }

    public function getPrzepis() : ?int
    {
        return $this->przepis;
    }

    public function setPrzepis(int $Przepis): self
    {
        $this->Przepis = $Przepis;

        return $this;
    }

    public function getSkladnik()
    {
        return $this->skladnik;
    }

    public function setSkladnik(int $Skladnik): self
    {
        $this->Skladnik = $Skladnik;

        return $this;
    }

    /**
     * @return Collection|JednostkiMiary[]
     */
    public function getJednostkaMiary(): Collection
    {
        return $this->jednostkaMiary;
    }

    public function addJednostkaMiary(JednostkiMiary $jednostkaMiary): self
    {
        if (!$this->jednostkaMiary->contains($jednostkaMiary)) {
            $this->jednostkaMiary[] = $jednostkaMiary;
            $jednostkaMiary->setJednostkaMiary($this);
        }

        return $this;
    }

    public function removeJednostkaMiary(JednostkiMiary $jednostkaMiary): self
    {
        if ($this->jednostkaMiary->contains($jednostkaMiary)) {
            $this->jednostkaMiary->removeElement($jednostkaMiary);
            // set the owning side to null (unless already changed)
            if ($jednostkaMiary->getJednostkaMiary() === $this) {
                $jednostkaMiary->setJednostkaMiary(null);
            }
        }

        return $this;
    }
}
