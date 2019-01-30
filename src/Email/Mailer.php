<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 07.01.19
 * Time: 17:59
 */

namespace App\Email;


use App\Entity\User;

class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var \Twig_Environment
     */
    private $twig;

    public function __construct(
          \Swift_Mailer $mailer,
          \Twig_Environment $twig
        )
        {
            $this->mailer = $mailer;
            $this->twig = $twig;
        }

    public function sendCinfirmationEmail(User $user)
    {
        $body = $this->twig->render('email/confirmation.html.twig',
            ['user' => $user]
        );

        $message = (new \Swift_Message('Proszę potwierdzić swój e-mail!'))
            ->setFrom('piotr.wojewoda.testing@gmail.com')
            ->setTo($user->getEmail())
            ->setBody($body,'text/html');

        $this->mailer->send($message);
    }


}
