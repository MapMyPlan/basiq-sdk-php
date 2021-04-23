<?php


namespace MMPBasiq\Entities;

class AffordabilityRegularIncomeIrregularity
{
    public $stability;
    public $gaps;

    public function __construct($irregularity)
    {
        $this->stability = $irregularity['stability'];
        $this->gaps = $irregularity['gaps'];
    }
}