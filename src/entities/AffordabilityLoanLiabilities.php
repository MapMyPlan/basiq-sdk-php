<?php


namespace MMPBasiq\Entities;

class AffordabilityLoanLiabilities
{
    public $currency;
    public $balance;
    public $availableFunds;
    public $account;
    public $institution;
    /** @var LoanLiabilitiesPreviousMonth */
    public $previousMonth;
    /** @var LoanLiabilitiesPreviousSixMonth */
    public $previous6Months;
}
