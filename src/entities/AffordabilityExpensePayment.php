<?php


namespace MMPBasiq\Entities;

class AffordabilityExpensePayment extends Entity
{

    public $division;
    public $averageMonthly;
    public $percentageTotal;
    /**
     * @var array
     */
    public $subCategories;

    public function __construct($body)
    {
        $this->division = $body['division'];
        $this->averageMonthly = $body['averageMonthly'];
        $this->percentageTotal = $body['percentageTotal'];
        $subCategories = [];
        foreach ($body['subCategory'] as $subCategory) {
            array_push($subCategories, new AffordabilityExpensePaymentSubCategory($subCategory));
        }
        $this->subCategories = $subCategories;
    }
}
