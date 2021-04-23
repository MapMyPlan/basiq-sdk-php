<?php


namespace MMPBasiq\Entities;

class AffordabilityAccount
{
    public $type;
    public $product;

    public function __construct($type, $product)
    {
        $this->type = $type;
        $this->product = $product;
    }
}
