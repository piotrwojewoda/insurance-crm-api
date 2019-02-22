<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class PeselValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }
        if (!is_scalar($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }
        $stringValue = (string) $value;
        $pesel = preg_replace('/[ -]/im', '', $stringValue);
        $length = strlen($pesel);
        if ($length != 11) {
            $this->context->addViolation(
                $constraint->message,
                array('%string%' => $value)
            );
            return;
        }
        $mod = 10;
        $sum = 0;
        $weights = array (1, 3, 7, 9, 1, 3, 7, 9, 1, 3);
        $digits = array();
        preg_match_all("/\d/", $pesel, $digits) ;
        $digitsArray = $digits[0];
        foreach ($digitsArray as $digit) {
            $weight = current($weights);
            $sum += $digit * $weight;
            next($weights);
        }
        if ( (((10 - ($sum % $mod) == 10) ? 0 : 10) - ($sum % $mod)) != $digitsArray[$length - 1] ) {
            $this->context->addViolation(
                $constraint->message,
                array('%string%' => $value)
            );
        }
    }

}
