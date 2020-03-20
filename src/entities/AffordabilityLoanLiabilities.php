<?php


namespace MMPBasiq\Entities;

class AffordabilityLoanLiabilities
{
    public $currency;
    public $balance;
    public $availableFunds;
    /** @var AffordabilityAccount */
    public $account;
    public $institution;
    /** @var LoanLiabilitiesPreviousMonth */
    public $previousMonth;
    /** @var LoanLiabilitiesPreviousSixMonth */
    public $previous6Months;

    public function __construct($data)
    {
        $this->currency = $data['currency'];
        $this->balance = $data['balance'];
        $this->availableFunds = $data['availableFunds'];
        $this->account = new AffordabilityAccount($data['account']['type'], $data['account']['product']);
        $this->institution = $data['institution'];
        $this->previousMonth = new LoanLiabilitiesPreviousMonth(
            $data['previousMonth']['totalCredits'],
            $data['previousMonth']['totalDebits']
        );
        if (isset($data['previous6Months'])) {
            $this->previous6Months = new LoanLiabilitiesPreviousSixMonth($data['previous6Months']['arrears']);
        } else {
            $this->previous6Months = new LoanLiabilitiesPreviousSixMonth(0);
        }
    }
}
