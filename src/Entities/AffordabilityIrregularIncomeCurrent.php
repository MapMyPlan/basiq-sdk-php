<?php


namespace MMPBasiq\Entities;

class AffordabilityIrregularIncomeCurrent
{
    public $date;
    public $amount;

    public function __construct($body)
    {
        $this->date = $body['date'];
        $this->amount = $body['amount'];
    }
}
