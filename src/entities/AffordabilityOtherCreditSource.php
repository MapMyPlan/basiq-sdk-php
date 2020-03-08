<?php


namespace MMPBasiq\Entities;

class AffordabilityOtherCreditSource
{
    public $source;
    public $ageDays;
    public $amountAvg;
    public $avgMonthlyOccurence;
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
        $this->ageDays = $body['ageDays'];
        $this->amountAvg = $body['amountAvg'];
        $this->avgMonthlyOccurence = $body['avgMonthlyOccurence'];
        $this->current = new AffordabilityOtherCreditSourceCurrent($body['current']);
        $changeArray = [];
        foreach ($body['changeHistory'] as $changeHistory) {
            array_push($changeArray, new AffordabilityIncomeChangeHistory($changeHistory));
        }
        $this->changeHistory = $changeArray;
    }
}
