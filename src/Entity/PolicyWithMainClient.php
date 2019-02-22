<?php

namespace App\Entity;


use App\Validator\Pesel;
use Symfony\Component\Validator\Constraints as Assert;

class PolicyWithMainClient
{
    /**
     * @Assert\NotBlank()
     */
    private $company;

    /**
     * @Assert\NotBlank()
     */
    private $code;

    /**
     * @Assert\NotBlank()
     */
    private $period;

    /**
     * @Assert\Date()
     */
    private $startDate;

    /**
     * @Assert\Date()
     */
    private $endDate;

    /**
     * @Assert\NotBlank()
     */

    private $clientFirstName;

    /**
     * @Assert\NotBlank()
     */
    private $clientLastName;

    /**
     * @Pesel()
     * @Assert\NotBlank()
     */

    private $pesel;

    /**
     * @Assert\NotBlank()
     */
    private $insuranceValue;


    public function getCompany(): ?int
    {
        return $this->company;
    }

    public function setCompany(int $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getPeriod(): ?string
    {
        return $this->period;
    }

    public function setPeriod(string $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate():  ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getClientFirstName(): ?string
    {
        return $this->clientFirstName;
    }

    public function setClientFirstName(string $clientFirstName): self
    {
        $this->clientFirstName = $clientFirstName;

        return $this;
    }

    public function getClientLastName(): ?string
    {
        return $this->clientLastName;
    }

    public function setClientLastName(string $clientLastName): self
    {
        $this->clientLastName = $clientLastName;

        return $this;
    }

    public function getPesel(): ?string
    {
        return $this->pesel;
    }

    public function setPesel(string $pesel): self
    {
        $this->pesel = $pesel;

        return $this;
    }

    public function getInsuranceValue():  ?int
    {
        return $this->insuranceValue;
    }

    public function setInsuranceValue(int $insuranceValue): self
    {
        $this->insuranceValue = $insuranceValue;
        return $this;
    }
}
