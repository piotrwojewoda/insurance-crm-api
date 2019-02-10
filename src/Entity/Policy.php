<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PolicyRepository")
 */
class Policy implements PublishedDateEntityInterface, AuthoredEntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-collection","get-item-policy"})
     */
    private $code;

    /**
     * @ORM\Column(type="date")
     * @Groups({"get-collection","get-item-policy"})
     */
    private $startdate;

    /**
     * @ORM\Column(type="date")
     * @Groups({"get-collection","get-item-policy"})
     */
    private $enddate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InsurancePeriodInTheCompany", mappedBy="policy", cascade="remove")
     */
    private $insurancePeriodInTheCompanies;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-collection","get-item-policy"})
     */
    private $period;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"get-collection","get-item-policy"})
     */
    private $published;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get-collection","get-item-policy"})
     */
    private $author;

    /**
     * @Groups({"get-item-policy"})
     */
    private $clients;


    /**
     * @Groups({"get-item-policy"})
     */
    private $company;



    public function __construct()
    {
        $this->insurancePeriodInTheCompanies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|InsurancePeriodInTheCompany[]
     */
    public function getInsurancePeriodInTheCompanies(): Collection
    {
        return $this->insurancePeriodInTheCompanies;
    }

    public function addInsurancePeriodInTheCompany(InsurancePeriodInTheCompany $insurancePeriodInTheCompany): self
    {
        if (!$this->insurancePeriodInTheCompanies->contains($insurancePeriodInTheCompany)) {
            $this->insurancePeriodInTheCompanies[] = $insurancePeriodInTheCompany;
            $insurancePeriodInTheCompany->setPolicy($this);
        }

        return $this;
    }

    public function removeInsurancePeriodInTheCompany(InsurancePeriodInTheCompany $insurancePeriodInTheCompany): self
    {
        if ($this->insurancePeriodInTheCompanies->contains($insurancePeriodInTheCompany)) {
            $this->insurancePeriodInTheCompanies->removeElement($insurancePeriodInTheCompany);
            // set the owning side to null (unless already changed)
            if ($insurancePeriodInTheCompany->getPolicy() === $this) {
                $insurancePeriodInTheCompany->setPolicy(null);
            }
        }

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

    public function getPublished(): ?\DateTimeInterface
    {
        return $this->published;
    }

    public function setPublished(\DateTimeInterface $published): PublishedDateEntityInterface
    {
        $this->published = $published;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?UserInterface $author): AuthoredEntityInterface
    {
        $this->author = $author;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getClients()
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

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company): void
    {
        $this->company = $company;
    }
}
