<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 07.01.19
 * Time: 14:33
 */

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class UserConfirmation
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=40,max=100)
     */
    public $confirmationToken;


}
