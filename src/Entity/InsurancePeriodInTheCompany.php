<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InsurancePeriodInTheCompanyRepository")
 */
class InsurancePeriodInTheCompany
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\Column(type="date")
     */
    private $startdate;

    /**
     * @ORM\Column(type="date")
     */
    private $enddate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Policy", inversedBy="insurancePeriodInTheCompanies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $policy;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\InsuranceValue")
     * @ORM\JoinColumn(nullable=false)
     */
    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getStartdate(): ?\DateTimeInterface
    {
        return $this->startdate;
    }

    public function setStartdate(\DateTimeInterface $startdate): self
    {
        $this->startdate = $startdate;

        return $this;
    }

    public function getEnddate(): ?\DateTimeInterface
    {
        return $this->enddate;
    }

    public function setEnddate(\DateTimeInterface $enddate): self
    {
        $this->enddate = $enddate;

        return $this;
    }

    public function getPolicy(): ?Policy
    {
        return $this->policy;
    }

    public function setPolicy(?Policy $policy): self
    {
        $this->policy = $policy;

        return $this;
    }

    public function getValue(): ?InsuranceValue
    {
        return $this->value;
    }

    public function setValue(?InsuranceValue $value): self
    {
        $this->value = $value;

        return $this;
    }
}
