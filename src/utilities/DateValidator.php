<?php


namespace MMPBasiq\Utilities;

class DateValidator
{
    public static function validate($input)
    {
        $date = \DateTime::createFromFormat('Y-m', $input);
        $date_errors = \DateTime::getLastErrors();
        $errors = [];
        if ($date_errors['warning_count'] + $date_errors['error_count'] > 0) {
            $errors[] = 'Some useful error message goes here.';
        }
        return $errors;
    }
}
