<?php


namespace MMPBasiq\Entities;

class AffordabilityExpense extends Entity
{
    public $id;
    public $type = 'income';
    public $fromMonth;
    public $toMonth;
    public $payments;
    public $cashWithdrawals;
    public $bankFees;
    public $externalTransfers;
    public $loanInterests;

    public function __construct($body)
    {
        $this->id = $body['id'];
        $this->fromMonth = $body['fromMonth'];
        $this->toMonth = $body['toMonth'];
        $payments = [];
        foreach ($body['payments'] as $payment) {
            array_push($payments, new AffordabilityExpensePayment($payment));
        }
        $this->payments = $payments;
        if (isset($body['cashWithdrawals'])) {
            $this->cashWithdrawals = new AffordabilityExpensesOtherOutgoings($body['cashWithdrawals']);
        }
        if (isset($body['bankFees'])) {
            $this->bankFees = new AffordabilityExpensesOtherOutgoings($body['bankFees']);
        }
        if (isset($body['externalTransfers'])) {
            $this->externalTransfers = new AffordabilityExpensesOtherOutgoings($body['externalTransfers']);
        }
        if (isset($body['loanInterests'])) {
            $this->loanInterests = new AffordabilityExpensesOtherOutgoings($body['loanInterests']);
        }
    }
}
