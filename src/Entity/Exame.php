<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExameRepository")
 */
class Exame
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Test", mappedBy="exames")
     */
    private $test;

    /**
     * @ORM\Column(type="integer")
     */
    private $Candidat;

    /**
     * @ORM\Column(type="integer")
     */
    private $score;

    public function __construct()
    {
        $this->test = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Test[]
     */
    public function getTest(): Collection
    {
        return $this->test;
    }

    public function setTest(int $test): self
    {
        $this->test = $test;

        return $this;
    }

    public function getCandidat(): ?int
    {
        return $this->Candidat;
    }

    public function setCandidat(int $Candidat): self
    {
        $this->Candidat = $Candidat;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function addTest(Test $test): self
    {
        if (!$this->test->contains($test)) {
            $this->test[] = $test;
            $test->setExames($this);
        }

        return $this;
    }

    public function removeTest(Test $test): self
    {
        if ($this->test->contains($test)) {
            $this->test->removeElement($test);
            // set the owning side to null (unless already changed)
            if ($test->getExames() === $this) {
                $test->setExames(null);
            }
        }

        return $this;
    }
}
