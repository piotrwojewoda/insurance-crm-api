<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 29.12.18
 * Time: 16:14
 */

namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\AuthoredEntityInterface;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class AuthoredEntitySubscriber implements EventSubscriberInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {

        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents() : array
    {
        return [
            KernelEvents::VIEW => ['getAuthenticatedUser',EventPriorities::PRE_WRITE]
        ];
    }

    public function getAuthenticatedUser(GetResponseForControllerResultEvent $event)
    {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        $token = $this->tokenStorage->getToken();

        if (null === $token)
        {
            return;
        }

        /** @var User $author */
        $author = $token->getUser();

        if (
        (!$entity instanceof AuthoredEntityInterface) || Request::METHOD_POST !== $method) {
            return;
        }
        $entity->setAuthor($author);
    }
}
