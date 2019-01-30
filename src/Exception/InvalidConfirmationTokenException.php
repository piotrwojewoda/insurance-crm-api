<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 11.01.19
 * Time: 15:52
 */

namespace App\Exception;

use Throwable;

class InvalidConfirmationTokenException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct('Confirmation token is invalid.', $code, $previous);
    }
}
