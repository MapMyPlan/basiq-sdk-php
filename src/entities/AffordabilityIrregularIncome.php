<?php


namespace MMPBasiq\Entities;

class AffordabilityIrregularIncome
{
    public $source;
    public $frequency;
    public $ageDays;
    public $amountAvg;
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
        $this->frequency = $body['frequency'];
        $this->ageDays = $body['ageDays'];
        $this->amountAvg = $body['amountAvg'];
        $this->current = new AffordabilityIrregularIncomeCurrent($body['current']);
        $changeArray = [];
        foreach ($body['changeHistory'] as $changeHistory) {
            array_push($changeArray, new AffordabilityIncomeChangeHistory($changeHistory));
        }
        $this->changeHistory = $changeArray;
    }
}