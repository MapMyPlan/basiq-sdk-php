<?php


namespace MMPBasiq\Entities;

class CreditLiabilitiesPreviousSixMonths
{
    public $cashAdvances;

    /**
     * CreditLiabilitiesPreviousSixMonths constructor.
     * @param $cashAdvances
     */
    public function __construct($cashAdvances)
    {
        $this->cashAdvances = $cashAdvances;
    }
}
