<?php


namespace MMPBasiq\Entities;

class AffordabilityRegularIncome
{
    public $source;
    public $frequency;
    public $ageDays;
    /** @var AffordabilityRegularIncomeIrregularity */
    public $irregularity;
    /**
     * @var AffordabilityRegularIncomePreviousThreeMonths
     */
    public $previous3Months;
    /**
     * @var AffordabilityRegularIncomeCurrent
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
        $this->irregularity = new AffordabilityRegularIncomeIrregularity($body['irregularity']);
        $this->previous3Months = new AffordabilityRegularIncomePreviousThreeMonths($body['previous3Months']);
        $this->current = new AffordabilityRegularIncomeCurrent($body['current']);
        $changeArray = [];
        foreach ($body['changeHistory'] as $changeHistory) {
            array_push($changeArray, new AffordabilityIncomeChangeHistory($changeHistory));
        }
        $this->changeHistory = $changeArray;
    }
}