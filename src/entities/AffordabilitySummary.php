<?php


namespace MMPBasiq\Entities;

class AffordabilitySummary
{
    public $assets;
    public $liabilities;
    public $netPosition;
    public $creditLimit;
    public $regularIncome;
    public $expenses;
    public $savings;

    public function __construct($body)
    {
        $this->assets = $body['assets'];
        $this->liabilities = $body['liabilities'];
        $this->netPosition = $body['netPosition'];
        $this->creditLimit = $body['creditLimit'];
        $this->expenses = $body['expenses'];
        $this->savings = $body['savings'];
        $this->regularIncome = $body['regularIncome']['previous3Months']['avgMonthly'];
    }
}
