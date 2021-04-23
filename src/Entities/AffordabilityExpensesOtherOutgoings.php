<?php


namespace MMPBasiq\Entities;

class AffordabilityExpensesOtherOutgoings
{
    public $avgMonthly;
    public $summary;
    /**
     * @var array
     */
    public $changeHistory;

    /**
     * AffordabilityExpensesOtherOutgoings constructor.
     * @param  mixed  $body
     */
    public function __construct($body)
    {
        $this->avgMonthly = $body['avgMonthly'];
        $this->summary = $body['summary'];
        $changeHistory = [];
        foreach ($body['changeHistory'] as $change) {
            array_push($changeHistory, new AffordabilityExpensePaymentChangeHistory($change));
        }
        $this->changeHistory = $changeHistory;
    }
}
