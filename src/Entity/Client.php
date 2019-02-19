<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-item-company","get-item-policy"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-item-company","get-item-policy"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-item-company","get-item-policy"})
     */
    private $idnumber;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"get-item-company","get-item-policy"})
     */
    private $sex;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get-item-company","get-item-policy"})
     */
    private $email;

    /**
     * @ORM\Column(type="date")
     * @Groups({"get-item-company","get-item-policy"})
     */
    private $birthdate;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"get-item-company","get-item-policy"})
     */
    private $foreigner;



    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }

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

    public function getIdnumber(): ?int
    {
        return $this->idnumber;
    }

    public function setIdnumber(string $idnumber): self
    {
        $this->idnumber = $idnumber;

        return $this;
    }

    public function getSex(): ?bool
    {
        return $this->sex;
    }

    public function setSex(bool $sex): self
    {
        $this->sex = $sex;

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

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getForeigner(): ?bool
    {
        return $this->foreigner;
    }

    public function setForeigner(bool $foreigner): self
    {
        $this->foreigner = $foreigner;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }
}
