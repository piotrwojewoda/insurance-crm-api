<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 20.02.19
 * Time: 18:33
 */

namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Client;
use App\Entity\InsurancePeriodInTheCompany;
use App\Entity\InsuranceValue;
use App\Entity\Policy;
use App\Entity\PolicyWithMainClient;
use App\Entity\User;
use App\Repository\CompanyRepository;
use App\Repository\InsuranceValueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraints\Date;

class PolicyWithMainClientSubscriber implements EventSubscriberInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var CompanyRepository
     */
    private $companyRepository;
    /**
     * @var InsuranceValue
     */
    private $insuranceValue;
    /**
     * @var InsuranceValueRepository
     */
    private $insuranceValueRepository;
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(
        EntityManagerInterface $entityManager,
        CompanyRepository $companyRepository,
        InsuranceValueRepository $insuranceValueRepository,
        TokenStorageInterface $tokenStorage
    )
    {
        $this->entityManager = $entityManager;
        $this->companyRepository = $companyRepository;
        $this->insuranceValueRepository = $insuranceValueRepository;
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['setCompany', EventPriorities::POST_VALIDATE]
        ];
    }

    public function setCompany(GetResponseForControllerResultEvent $event) {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        $token = $this->tokenStorage->getToken();

        /** @var User $author */
        $author = $token->getUser();
        if (null === $token)
        {
            return;
        }

        if (
            (!$entity instanceof PolicyWithMainClient) || Request::METHOD_POST !== $method) {
            return;
        }

        $company = $this->companyRepository->find($entity->getCompany());
        $insuranceValue = $this->insuranceValueRepository->find($entity->getInsuranceValue());

        $policy = new Policy();
        $policy->setPeriod($entity->getPeriod());
        $policy->setCode($entity->getCode());
        $policy->setStartdate($entity->getStartDate());
        $policy->setEnddate($entity->getEndDate());
        $policy->setPublished(new \DateTime());
        $policy->setAuthor($author);

        $client = new Client();
        $client->setSex(0);
        $client->setIdnumber($entity->getPesel());
        $client->setLastname($entity->getClientLastName());
        $client->setFirstname($entity->getClientFirstName());
        $client->setForeigner(0);
        $client->setBirthdate(new \DateTime());

        $insurancePeriodInTheCompany = new InsurancePeriodInTheCompany();
        $insurancePeriodInTheCompany->setStartdate($entity->getStartDate());
        $insurancePeriodInTheCompany->setEnddate($entity->getEndDate());
        $insurancePeriodInTheCompany->setPolicy($policy);
        $insurancePeriodInTheCompany->setCompany($company);
        $insurancePeriodInTheCompany->setValue($insuranceValue);
        $insurancePeriodInTheCompany->setClient($client);

        $this->entityManager->persist($policy);
        $this->entityManager->persist($client);
        $this->entityManager->persist($insurancePeriodInTheCompany);

        $this->entityManager->flush();
        $event->setResponse(new JsonResponse(null, Response::HTTP_OK));
    }
}
