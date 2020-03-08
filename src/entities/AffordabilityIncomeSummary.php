<?php


namespace MMPBasiq\Entities;

class AffordabilityIncomeSummary
{
    public $regularIncomeAvg;
    public $regularIncomeYTD;
    public $regularIncomeYear;
    public $irregularIncomeAvg;

    public function __construct($body)
    {
        $this->regularIncomeAvg = $body['regularIncomeAvg'];
        $this->regularIncomeYTD = $body['regularIncomeYTD'];
        $this->regularIncomeYear = $body['regularIncomeYear'];
        $this->irregularIncomeAvg = $body['irregularIncomeAvg'];
    }
}
