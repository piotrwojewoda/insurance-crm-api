<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 */
class Company
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-item-company","get-collections-company"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-item-company","get-collections-company"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups({"get-item-company"})
     */
    private $longName;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"get-item-company"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"get-item-company"})
     */
    private $regon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get-item-company"})
     */
    private $email;

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     * @Groups({"get-item-company"})
     *
     */
    private $latLen = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get-item-company"})
     */
    private $phone;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="companies")
     * @Groups({"get-item-company","get-collections-company"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get-item-company"})
     */
    private $address;


    /**
     * @Groups({"get-item-company"})
     */
    private $clients;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLongName(): ?string
    {
        return $this->longName;
    }

    public function setLongName(string $longName): self
    {
        $this->longName = $longName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRegon(): ?int
    {
        return $this->regon;
    }

    public function setRegon(?int $regon): self
    {
        $this->regon = $regon;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLatLen(): ?array
    {
        return $this->latLen;
    }

    public function setLatLen(?array $latLen): self
    {
        $this->latLen = $latLen;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClients() : ?array
    {
        return $this->clients;
    }

    /**
     * @param mixed $clients
     */
    public function setClients($clients): void
    {
        $this->clients = $clients;
    }
}
