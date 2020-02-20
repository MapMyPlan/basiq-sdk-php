<?php


namespace MMPBasiq\Entities;

class AssetsPreviousSixMonths
{
    public $minBalance;
    public $maxBalance;

    /**
     * AssetsPreviousSixMonths constructor.
     * @param $minBalance
     * @param $maxBalance
     */
    public function __construct($minBalance, $maxBalance)
    {
        $this->minBalance = $minBalance;
        $this->maxBalance = $maxBalance;
    }
}
