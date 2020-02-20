<?php


namespace MMPBasiq\Entities;

class AffordabilityCreditLiabilities
{
    public $currency;
    public $balance;
    public $availableFunds;
    public $account;
    public $institution;
    /** @var CreditLiabilitiesPreviousMonth */
    public $previousMonth;
    /** @var CreditLiabilitiesPreviousSixMonths */
    public $previous6months;
    public $creditLimit;
}
