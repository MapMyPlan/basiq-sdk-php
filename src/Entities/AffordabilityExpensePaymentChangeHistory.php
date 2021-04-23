<?php


namespace MMPBasiq\Entities;

class AffordabilityExpensePaymentChangeHistory extends Entity
{

    public $amount;
    public $date;

    public function __construct($body)
    {
        $this->amount = $body['amount'];
        $this->date = $body['date'];
    }
}
