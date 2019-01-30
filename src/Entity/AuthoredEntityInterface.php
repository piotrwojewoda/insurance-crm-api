<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 30.12.18
 * Time: 19:06
 */

namespace App\Entity;


use Symfony\Component\Security\Core\User\UserInterface;

interface AuthoredEntityInterface
{
    public function setAuthor(UserInterface $user): AuthoredEntityInterface;
}
