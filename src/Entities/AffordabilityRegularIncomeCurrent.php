<?php


namespace MMPBasiq\Entities;

class AffordabilityRegularIncomeCurrent
{
    public $date;
    public $amount;
    public $nextDate;

    public function __construct($body)
    {
        $this->date = $body['date'];
        $this->amount = $body['amount'];
        $this->nextDate = $body['nextDate'];
    }
}
