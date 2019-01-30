<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 07.01.19
 * Time: 13:30
 */

namespace App\Security;


use App\Entity\User;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserEnabledChecker implements UserCheckerInterface
{

    /**
     * Checks the user account before authentication.
     *
     * @throws AccountStatusException
     */
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof User)
        {
            return;
        }

        if (!$user->getEnabled()){
            throw new DisabledException();
        }

    }

    /**
     * Checks the user account after authentication.
     *
     * @throws AccountStatusException
     */
    public function checkPostAuth(UserInterface $user)
    {
        // TODO: Implement checkPostAuth() method.
    }
}
