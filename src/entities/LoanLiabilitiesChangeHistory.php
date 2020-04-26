<?php


namespace MMPBasiq\Entities;

class LoanLiabilitiesChangeHistory
{
    /**
     * @var mixed
     */
    public $direction;
    /**
     * @var mixed
     */
    public $amount;
    /**
     * @var mixed
     */
    public $date;
    /**
     * @var mixed
     */
    public $source;

    /**
     * LoanLiabilitiesChangeHistory constructor.
     * @param $arrears
     */
    public function __construct($data)
    {
        $this->direction = $data['direction'];
        $this->amount = $data['amount'];
        $this->date = $data['date'];
        $this->source = $data['source'];
    }
}
