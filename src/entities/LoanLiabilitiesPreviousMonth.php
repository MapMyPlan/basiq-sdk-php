<?php


namespace MMPBasiq\Entities;

class LoanLiabilitiesPreviousMonth
{
    public $totalCredits;
    public $totalDebits;


    /**
     * CreditLiabilitiesPreviousMonth constructor.
     * @param $totalCredits
     * @param $totalDebits
     */
    public function __construct($totalCredits, $totalDebits)
    {
        $this->totalCredits = $totalCredits;
        $this->totalDebits = $totalDebits;

    }
}
