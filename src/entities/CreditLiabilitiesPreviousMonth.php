<?php


namespace MMPBasiq\Entities;

class CreditLiabilitiesPreviousMonth
{
    public $totalCredits;
    public $totalDebits;
    public $minBalance;
    public $maxBalance;

    /**
     * CreditLiabilitiesPreviousMonth constructor.
     * @param $totalCredits
     * @param $totalDebits
     * @param $minBalance
     * @param $maxBalance
     */
    public function __construct($totalCredits, $totalDebits, $minBalance, $maxBalance)
    {
        $this->totalCredits = $totalCredits;
        $this->totalDebits = $totalDebits;
        $this->minBalance = $minBalance;
        $this->maxBalance = $maxBalance;
    }
}
