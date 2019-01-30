<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 20.01.19
 * Time: 22:53
 */

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationSuccessListener
{
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        $data['id'] = $user->getId();

        $event->setData($data);
    }
}
