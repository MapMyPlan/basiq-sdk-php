<?php


namespace MMPBasiq\Entities;

class AffordabilityRegularIncomePreviousThreeMonths
{
    public $amountAvg;
    public $amountAvgMonthly;
    public $variance;

    public function __construct($body)
    {
        $this->amountAvg = $body['amountAvg'];
        $this->amountAvgMonthly = $body['amountAvgMonthly'];
        $this->variance = $body['variance'];
    }
}