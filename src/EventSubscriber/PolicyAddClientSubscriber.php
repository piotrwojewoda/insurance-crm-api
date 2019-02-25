<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 22.02.19
 * Time: 16:30
 */

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Client;
use App\Entity\ClientToPolicy;
use App\Entity\InsurancePeriodInTheCompany;
use App\Repository\CompanyRepository;
use App\Repository\InsuranceValueRepository;
use App\Repository\PolicyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class PolicyAddClientSubscriber implements EventSubscriberInterface
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
     * @var InsuranceValueRepository
     */
    private $insuranceValueRepository;
    /**
     * @var PolicyRepository
     */
    private $policyRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        CompanyRepository $companyRepository,
        InsuranceValueRepository $insuranceValueRepository,
        PolicyRepository $policyRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->companyRepository = $companyRepository;
        $this->insuranceValueRepository = $insuranceValueRepository;
        $this->policyRepository = $policyRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['addClientToPolicy', EventPriorities::POST_VALIDATE]
        ];
    }

    public function addClientToPolicy(GetResponseForControllerResultEvent $event)
    {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (
            (!$entity instanceof ClientToPolicy) || Request::METHOD_POST !== $method) {
            return;
        }
        $company = $this->companyRepository->find($entity->getCompany());
        $insuranceValue = $this->insuranceValueRepository->find($entity->getSelectedValue());
        $policy = $this->policyRepository->find($entity->getPolicy());

        $client = new Client();
        $client->setFirstname($entity->getFirstname());
        $client->setLastname($entity->getLastname());
        $client->setIdnumber($entity->getPesel());
        $client->setForeigner(0);
        $client->setSex(0); // TODO Adding getting sex value from pesel
        $client->setBirthdate(new \DateTime('now')); // TODO Adding getting birthdate from pesel

        $insurancePeriodInTheCompany = new InsurancePeriodInTheCompany();
        $insurancePeriodInTheCompany->setClient($client);
        $insurancePeriodInTheCompany->setCompany($company);
        $insurancePeriodInTheCompany->setValue($insuranceValue);
        $insurancePeriodInTheCompany->setPolicy($policy);
        $insurancePeriodInTheCompany->setStartdate($policy->getStartdate());
        $insurancePeriodInTheCompany->setEnddate($policy->getEnddate());

        $this->entityManager->persist($client);
        $this->entityManager->persist($insurancePeriodInTheCompany);
        $this->entityManager->flush();

        $event->setResponse(new JsonResponse(null, Response::HTTP_OK));
    }
}
