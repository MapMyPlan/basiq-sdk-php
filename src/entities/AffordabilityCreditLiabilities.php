<?php


namespace MMPBasiq\Entities;

class AffordabilityCreditLiabilities
{
    public $currency;
    public $balance;
    public $availableFunds;
    /** @var AffordabilityAccount */
    public $account;
    public $institution;
    /** @var CreditLiabilitiesPreviousMonth */
    public $previousMonth;
    /** @var CreditLiabilitiesPreviousSixMonths */
    public $previous6Months;
    public $creditLimit;

    public function __construct($data)
    {
        $this->currency = $data['currency'];
        $this->balance = $data['balance'];
        $this->availableFunds = $data['availableFunds'];
        $this->account = new AffordabilityAccount($data['account']['type'], $data['account']['product']);
        $this->institution = $data['institution'];
        $this->previousMonth = new CreditLiabilitiesPreviousMonth(
            $data['previousMonth']['totalCredits'],
            $data['previousMonth']['totalDebits'],
            $data['previousMonth']['minBalance'],
            $data['previousMonth']['maxBalance'],
        );
        $this->previous6Months = new CreditLiabilitiesPreviousSixMonths($data['previous6Months']['cashAdvances']);
        $this->creditLimit = $data['creditLimit'];
    }
}
