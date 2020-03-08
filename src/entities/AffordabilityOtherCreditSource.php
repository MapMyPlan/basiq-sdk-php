<?php


namespace MMPBasiq\Entities;

class AffordabilityOtherCreditSource
{
    public $source;
    public $ageDay;
    public $amountAvg;
    public $avgMonthlyOccurrence;
    /**
     * @var AffordabilityIrregularIncomeCurrent
     */
    public $current;
    /**
     * @var array
     */
    public $changeHistory;


    public function __construct($body)
    {
        $this->source = $body['source'];
        $this->ageDay = $body['ageDay'];
        $this->amountAvg = $body['amountAvg'];
        $this->avgMonthlyOccurrence = $body['avgMonthlyOccurrence'];
        $this->current = new AffordabilityOtherCreditSourceCurrent($body['current']);
        $changeArray = [];
        foreach ($body['changeHistory'] as $changeHistory) {
            array_push($changeArray, new AffordabilityIncomeChangeHistory($changeHistory));
        }
        $this->changeHistory = $changeArray;
    }
}
