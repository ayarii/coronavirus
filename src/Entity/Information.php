<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InformationRepository")
 * @ORM\Table(name="information")
 */
class Information
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="integer")
     */
    private $cin;

    /**
     * @ORM\Column(type="string")
     */
    private $gender;

    /**
     * @ORM\Column(type="boolean")
     */
    private $fever;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cough;

    /**
     * @ORM\Column(type="boolean")
     */
    private $lossOfTaste;

    /**
     * @ORM\Column(type="boolean")
     */
    private $soreThroat;

    /**
     * @ORM\Column(type="boolean")
     */
    private $tired;

    /**
     * @ORM\Column(type="boolean")
     */
    private $diarrhea;

    /**
     * @ORM\Column(type="boolean")
     */
   private $problemFeeding;

    /**
     * @ORM\Column(type="boolean")
     */
    private $pregnant;

    /**
     * @ORM\Column(type="text")
     */
    private $treatment;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(name="updated", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updated;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(int $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getFever()
    {
        return $this->fever;
    }

    /**
     * @param mixed $fever
     */
    public function setFever($fever): void
    {
        $this->fever = $fever;
    }

    /**
     * @return mixed
     */
    public function getCough()
    {
        return $this->cough;
    }

    /**
     * @param mixed $cough
     */
    public function setCough($cough): void
    {
        $this->cough = $cough;
    }

    /**
     * @return mixed
     */
    public function getLossOfTaste()
    {
        return $this->lossOfTaste;
    }

    /**
     * @param mixed $lossOfTaste
     */
    public function setLossOfTaste($lossOfTaste): void
    {
        $this->lossOfTaste = $lossOfTaste;
    }

    /**
     * @return mixed
     */
    public function getSoreThroat()
    {
        return $this->soreThroat;
    }

    /**
     * @param mixed $soreThroat
     */
    public function setSoreThroat($soreThroat): void
    {
        $this->soreThroat = $soreThroat;
    }

    /**
     * @return mixed
     */
    public function getTired()
    {
        return $this->tired;
    }

    /**
     * @param mixed $tired
     */
    public function setTired($tired): void
    {
        $this->tired = $tired;
    }

    /**
     * @return mixed
     */
    public function getDiarrhea()
    {
        return $this->diarrhea;
    }

    /**
     * @param mixed $diarrhea
     */
    public function setDiarrhea($diarrhea): void
    {
        $this->diarrhea = $diarrhea;
    }

    /**
     * @return mixed
     */
    public function getProblemFeeding()
    {
        return $this->problemFeeding;
    }

    /**
     * @param mixed $problemFeeding
     */
    public function setProblemFeeding($problemFeeding): void
    {
        $this->problemFeeding = $problemFeeding;
    }

    /**
     * @return mixed
     */
    public function getPregnant()
    {
        return $this->pregnant;
    }

    /**
     * @param mixed $pregnant
     */
    public function setPregnant($pregnant): void
    {
        $this->pregnant = $pregnant;
    }

    /**
     * @return mixed
     */
    public function getTreatment()
    {
        return $this->treatment;
    }

    /**
     * @param mixed $treatment
     */
    public function setTreatment($treatment): void
    {
        $this->treatment = $treatment;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created): void
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     */
    public function setUpdated($updated): void
    {
        $this->updated = $updated;
    }

}
