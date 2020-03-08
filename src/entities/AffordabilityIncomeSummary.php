<?php


namespace MMPBasiq\Entities;

class AffordabilityIncomeSummary
{
    public $regularIncome;
    public $regularIncomeYTD;
    public $regularIncomeYear;
    public $irregularIncomeYear;

    public function __construct($body)
    {
        $this->regularIncome = $body['regularIncome'];
        $this->regularIncomeYTD = $body['regularIncomeYTD'];
        $this->regularIncomeYear = $body['regularIncomeYear'];
        $this->irregularIncomeYear = $body['irregularIncomeYear'];
    }
}
