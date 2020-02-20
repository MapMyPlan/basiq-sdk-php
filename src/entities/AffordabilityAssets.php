<?php


namespace MMPBasiq\Entities;

class AffordabilityAssets
{
    public $currency;
    public $balance;
    public $availableFunds;
    public $account;
    public $institution;
    /** @var AssetsPreviousSixMonths */
    public $previous6months;
}
