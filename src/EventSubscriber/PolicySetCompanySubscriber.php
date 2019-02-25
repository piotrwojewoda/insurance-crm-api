<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 04.02.19
 * Time: 11:06
 */

namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Policy;
use App\Repository\CompanyRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class PolicySetCompanySubscriber implements EventSubscriberInterface
{
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
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

        if (
            (!$entity instanceof Policy) || Request::METHOD_GET !== $method) {


            return;
        }

        $company = $this->companyRepository->findCompanyByPolicy($entity->getId());
        $entity->setCompany($company);
    }



}
