<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestRepository")
 */
class Test
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Question", mappedBy="tests")
     */
    private $questions;

    /**
     * @ORM\ManyToOne(targetEntity="Candidate", inversedBy="tests")
     */
    private $candidate;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalScore;

    /**
     * @ORM\OneToMany(targetEntity="Score", mappedBy="test")
     */
    private $questionScores;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->questionScores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalScore(): ?int
    {
        return $this->totalScore;
    }

    public function setTotalScore(int $totalScore): self
    {
        $this->totalScore = $totalScore;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->addTest($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            $question->removeTest($this);
        }

        return $this;
    }

    public function getCandidate(): ?Candidate
    {
        return $this->candidate;
    }

    public function setCandidate(?Candidate $candidate): self
    {
        $this->candidate = $candidate;

        return $this;
    }

    /**
     * @return Collection|Score[]
     */
    public function getQuestionScores(): Collection
    {
        return $this->questionScores;
    }

    public function addQuestionScore(Score $questionScore): self
    {
        if (!$this->questionScores->contains($questionScore)) {
            $this->questionScores[] = $questionScore;
            $questionScore->setTest($this);
        }

        return $this;
    }

    public function removeQuestionScore(Score $questionScore): self
    {
        if ($this->questionScores->contains($questionScore)) {
            $this->questionScores->removeElement($questionScore);
            // set the owning side to null (unless already changed)
            if ($questionScore->getTest() === $this) {
                $questionScore->setTest(null);
            }
        }

        return $this;
    }

}
