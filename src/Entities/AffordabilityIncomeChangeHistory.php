<?php


namespace MMPBasiq\Entities;

class AffordabilityIncomeChangeHistory
{
    public $source;
    public $amount;
    public $date;

    public function __construct($body)
    {
        $this->source = $body['source'];
        $this->amount = $body['amount'];
        $this->date = $body['date'];
    }
}
