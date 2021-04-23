<?php


namespace MMPBasiq\Entities;

class LoanLiabilitiesPreviousSixMonth
{
    public $arrears;

    /**
     * CreditLiabilitiesPreviousMonth constructor.
     * @param $arrears
     */
    public function __construct($arrears)
    {
        $this->arrears = $arrears;

    }
}
