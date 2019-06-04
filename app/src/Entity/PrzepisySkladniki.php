<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToOne(targetEntity="Przepisy", inversedBy="id_skladnik")
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
    private $IloscSkladnika;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JednostkiMiary", mappedBy="JednostkaMiary")
     */
    private $JednostkaMiary;

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
        return $this->IloscSkladnika;
    }

    public function setIloscSkladnika(int $IloscSkladnika): self
    {
        $this->IloscSkladnika = $IloscSkladnika;

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

    public function getSkladnik() : ?int
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
        return $this->JednostkaMiary;
    }

    public function addJednostkaMiary(JednostkiMiary $jednostkaMiary): self
    {
        if (!$this->JednostkaMiary->contains($jednostkaMiary)) {
            $this->JednostkaMiary[] = $jednostkaMiary;
            $jednostkaMiary->setJednostkaMiary($this);
        }

        return $this;
    }

    public function removeJednostkaMiary(JednostkiMiary $jednostkaMiary): self
    {
        if ($this->JednostkaMiary->contains($jednostkaMiary)) {
            $this->JednostkaMiary->removeElement($jednostkaMiary);
            // set the owning side to null (unless already changed)
            if ($jednostkaMiary->getJednostkaMiary() === $this) {
                $jednostkaMiary->setJednostkaMiary(null);
            }
        }

        return $this;
    }
}
