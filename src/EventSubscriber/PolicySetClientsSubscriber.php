<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 30.01.19
 * Time: 12:10
 */

namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Policy;
use App\Repository\ClientRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class PolicySetClientsSubscriber implements EventSubscriberInterface
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public static function getSubscribedEvents() : array
    {
        return [
            KernelEvents::VIEW => ['setClientToPolicy', EventPriorities::POST_VALIDATE]
        ];
    }

    public function setClientToPolicy(GetResponseForControllerResultEvent $event) {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        if (
            (!$entity instanceof Policy) || Request::METHOD_GET !== $method) {
            return;
        }
        $clients = $this->clientRepository->findCurrentClientsByPolicy($entity->getId());
        $entity->setClients($clients);
    }
}
