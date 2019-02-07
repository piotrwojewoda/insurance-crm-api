<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 06.02.19
 * Time: 11:44
 */

namespace App\EventSubscriber;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Client;
use App\Repository\InsuranceValueRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ClientSetValueSubscriber implements EventSubscriberInterface
{
    /**
     * @var InsuranceValueRepository
     */
    private $insuranceValueRepository;

    public function __construct(InsuranceValueRepository $insuranceValueRepository)
    {
        $this->insuranceValueRepository = $insuranceValueRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['setValueToClient', EventPriorities::POST_VALIDATE]
        ];
    }

    public function setValueToClient(GetResponseForControllerResultEvent $event) {

        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        if (
            (!$entity instanceof Client) || Request::METHOD_GET !== $method) {
            return;
        }

        $value = $this->insuranceValueRepository->findValueByClient($entity->getId());
        $entity->setValue($value[0]);
    }

}
