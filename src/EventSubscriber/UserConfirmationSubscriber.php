<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 07.01.19
 * Time: 14:43
 */

namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\UserConfirmation;
use App\Security\UserConfirmationService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class UserConfirmationSubscriber implements EventSubscriberInterface
{
    public const API_USER_CONFIRMATIONS_POST_COLLECTION = 'api_user_confirmations_post_collection';
    /**
     * @var UserConfirmationService
     */
    private $userConfirmationService;

    public function __construct(UserConfirmationService $userConfirmationService)
    {
        $this->userConfirmationService = $userConfirmationService;
    }

    public static function getSubscribedEvents()
    {
        return [KernelEvents::VIEW => ['confirmUser', EventPriorities::POST_VALIDATE]];
    }

    public function confirmUser(GetResponseForControllerResultEvent $event)
    {
        $request = $event->getRequest();

        if (self::API_USER_CONFIRMATIONS_POST_COLLECTION !== $request->get('_route')) {
            return;
        }
        /** @var UserConfirmation $confirmationToken */
        $confirmationToken = $event->getControllerResult();
        $this->userConfirmationService->confirmUser($confirmationToken->confirmationToken);
        $event->setResponse(new JsonResponse(null, Response::HTTP_OK));
    }
}



