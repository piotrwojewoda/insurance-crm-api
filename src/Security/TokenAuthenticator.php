<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 07.01.19
 * Time: 12:12
 */

namespace App\Security;


use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\ExpiredTokenException;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authentication\Token\PreAuthenticationJWTUserToken;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Guard\JWTTokenAuthenticator;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class TokenAuthenticator extends JWTTokenAuthenticator
{
    /**
     * @param PreAuthenticationJWTUserToken $preAuthToken
     * @param UserProviderInterface $userProvider
     * @throws ExpiredTokenException
     * @return User
     */
    public function getUser($preAuthToken, UserProviderInterface $userProvider) : User
    {
        /** @var User $user */
       $user = parent::getUser($preAuthToken, $userProvider);

        if ($user->getPasswordChangeDate() && $preAuthToken->getPayload()['iat']  < $user->getPasswordChangeDate() )
        {
            throw new ExpiredTokenException();
        }

        return $user;
    }
}
