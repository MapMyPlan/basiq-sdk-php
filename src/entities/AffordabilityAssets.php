<?php


namespace MMPBasiq\Entities;

class AffordabilityAssets
{
    public $currency;
    public $balance;
    public $availableFunds;
    /** @var AffordabilityAccount */
    public $account;
    public $institution;
    /** @var AssetsPreviousSixMonths */
    public $previous6months;

    public function __construct($data)
    {
        $this->currency = $data['currency'];
        $this->balance = $data['balance'];
        $this->availableFunds = $data['availableFunds'];
        $this->account = new AffordabilityAccount($data['account']['type'], $data['account']['product']);
        $this->institution = $data['institution'];
        $this->previous6months = new AssetsPreviousSixMonths(
            $data['previous6Months']['minBalance'],
            $data['previous6Months']['maxBalance']
        );
    }
}
