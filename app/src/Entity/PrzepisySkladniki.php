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

    public function getPrzepis()
    {
        return $this->przepis;
    }

    public function setPrzepis( $Przepis): self
    {
        $this->Przepis = $Przepis;

        return $this;
    }

    public function addPrzepis(Przepisy $przepisy): self
    {
        if (!$this->przepis->contains($przepisy)) {
            $this->przepis[] = $przepisy;
            $przepisy->setPrzepisy($this);
        }

        return $this;
    }

    public function removePrzepis(Przepisy $przepisy): self
    {
        if ($this->przepis->contains($przepisy)) {
            $this->przepis->removeElement($przepisy);
            // set the owning side to null (unless already changed)
            if ($przepisy->getSkladnik() === $this) {
                $przepisy->setSkladnik(null);
            }
        }

        return $this;
    }


    public function getSkladnik()
    {
        return $this->skladnik;
    }

    public function setSkladnik($skladnik): self
    {
        $this->skladnik = $skladnik;

        return $this;
    }
    public function addSkladnik(Skladniki $skladniki): self
    {
        if (!$this->skladnik->contains($skladniki)) {
            $this->skladnik[] = $skladniki;
            $skladniki->setPrzepisy($this);
        }

        return $this;
    }

    public function removeSkladnik(Skladniki $skladniki): self
    {
        if ($this->skladnik->contains($skladniki)) {
            $this->skladnik->removeElement($skladniki);
            // set the owning side to null (unless already changed)
            if ($skladniki->getPrzepisy() === $this) {
                $skladniki->setPrzepisy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|JednostkiMiary[]
     */
    public function getJednostkaMiary()
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
