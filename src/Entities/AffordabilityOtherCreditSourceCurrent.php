<?php


namespace MMPBasiq\Entities;

class AffordabilityOtherCreditSourceCurrent
{
    public $date;
    public $amount;
    public $otherCreditLabel;

    public function __construct($body)
    {
        $this->date = $body['date'];
        $this->amount = $body['amount'];
        $this->otherCreditLabel = $body['otherCreditLabel'];
    }
}
