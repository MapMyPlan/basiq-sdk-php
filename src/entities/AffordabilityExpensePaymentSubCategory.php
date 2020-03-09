<?php


namespace MMPBasiq\Entities;

class AffordabilityExpensePaymentSubCategory extends Entity
{
    public $summary;
    /**
     * @var Null|ExpenseCategoryCode
     */
    public $class;
    /**
     * @var Null|ExpenseCategoryCode
     */
    public $group;
    /**
     * @var Null|ExpenseCategoryCode
     */
    public $subDivision;
    /**
     * @var Null|ExpenseCategoryCode
     */
    public $division;

    public function __construct($body)
    {
        $this->summary = $body['summary'];
        $category = $body['category'];
        $this->class = new ExpenseCategoryCode($category['class']);
        $changeHistory = [];
        foreach ($body['changeHistory'] as $item) {
            array_push($changeHistory, new AffordabilityExpensePaymentChangeHistory($item));
        }
    }
}
