<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 28.01.19
 * Time: 20:44
 */

namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Company;
use App\Repository\ClientRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;


/*
 * This subscriber adds current clients if you do GET request on company
 */

class CompanySetClientsSubscriber implements EventSubscriberInterface
{

    /**
     * @var ClientRepository
     */
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['setClientToCompany', EventPriorities::POST_VALIDATE]
        ];
    }

    public function setClientToCompany(GetResponseForControllerResultEvent $event)
    {

        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        if (
            (!$entity instanceof Company) || Request::METHOD_GET !== $method) {
            return;
        }
        $clients = $this->clientRepository->findCurrentClientsByCompany($entity->getId());

        $entity->setClients($clients);
    }
}
