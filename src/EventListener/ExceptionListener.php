<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 15.01.19
 * Time: 21:10
 */

namespace App\EventListener;


use ApiPlatform\Core\Exception\ItemNotFoundException;
use ApiPlatform\Core\Bridge\Symfony\Validator\Exception\ValidationException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\EventListener\ExceptionListener as BaseExceptionListener;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use ApiPlatform\Core\Exception\InvalidArgumentException;

class ExceptionListener extends BaseExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $request = $event->getRequest();
        if (
            'html' === $request->getRequestFormat('') ||
            (!$request->attributes->has('_api_resource_class') && !$request->attributes->has('_api_respond') && !$request->attributes->has('_graphql'))
        ) {
            return;
        }
        $exception = $event->getException();

        if ($exception instanceof  InvalidArgumentException
            && $exception->getPrevious() instanceof ItemNotFoundException
            || $exception instanceof AccessDeniedException )
        {
            $violations = new ConstraintViolationList(
               [
                   new ConstraintViolation($exception->getMessage(),null,[],'','','')
               ]
            );

            $e = new ValidationException($violations);
            $event->setException($e);
                return;
        }
    }
}
