<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InsuranceValueRepository")
 */
class InsuranceValue
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\InsuranceType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $insuranceType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\InsuranceCategory")
     * @ORM\JoinColumn(nullable=false)
     */
    private $insuranceCategory;

    /**
     * @ORM\Column(type="float")
     */
    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInsuranceType(): ?InsuranceType
    {
        return $this->insuranceType;
    }

    public function setInsuranceType(?InsuranceType $insuranceType): self
    {
        $this->insuranceType = $insuranceType;

        return $this;
    }

    public function getInsuranceCategory(): ?InsuranceCategory
    {
        return $this->insuranceCategory;
    }

    public function setInsuranceCategory(?InsuranceCategory $insuranceCategory): self
    {
        $this->insuranceCategory = $insuranceCategory;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }
}
