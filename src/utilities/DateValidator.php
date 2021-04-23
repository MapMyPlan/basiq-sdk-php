<?php


namespace MMPBasiq\Utilities;

use DateTime;

class DateValidator
{
    public static function validate($input): array
    {
        DateTime::createFromFormat('Y-m', $input);
        $date_errors = DateTime::getLastErrors();
        $errors = [];
        if ($date_errors['warning_count'] + $date_errors['error_count'] > 0) {
            $errors[] = 'Some useful error message goes here.';
        }
        return $errors;
    }

    public static function minPeriod($from, $to): bool
    {
        $from = DateTime::createFromFormat('Y-m', $from);
        $to = DateTime::createFromFormat('Y-m', $to);
        $dif = $to->diff($from)->m;
        return ($dif >= 3);
    }
}
