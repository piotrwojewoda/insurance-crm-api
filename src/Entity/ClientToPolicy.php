<?php

namespace App\Entity;

use App\Validator\Pesel;
use Symfony\Component\Validator\Constraints as Assert;

class ClientToPolicy
{
    /**
     * @Assert\NotBlank()
     */
    private $firstname;

    /**
     * @Assert\NotBlank()
     */
    private $lastname;

    /**
     * @Pesel()
     * @Assert\NotBlank()
     */
    private $pesel;

    private $selectedValue;

    private $policy;

    private $company;

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getSelectedValue(): ?int
    {
        return $this->selectedValue;
    }

    public function setSelectedValue(int $selectedValue): self
    {
        $this->selectedValue = $selectedValue;

        return $this;
    }

    public function getPolicy(): ?int
    {
        return $this->policy;
    }

    public function setPolicy(int $policy): self
    {
        $this->policy = $policy;

        return $this;
    }

    public function getCompany() : ?int
    {
        return $this->company;
    }


    public function setCompany($company): self
    {
        $this->company = $company;

        return $this;
    }
}
