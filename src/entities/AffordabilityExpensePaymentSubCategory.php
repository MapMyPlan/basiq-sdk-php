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

    /** @var array  */
    public $changeHistory;

    public function __construct($body)
    {
        $this->summary = $body['summary'];
        $category = $body['category'];
        $this->class = new ExpenseCategoryCode($category['expenseClass']);
        $changeHistory = [];
        foreach ($body['changeHistory'] as $item) {
            array_push($changeHistory, new AffordabilityExpensePaymentChangeHistory($item));
        }
        $this->changeHistory = $changeHistory;
    }
}
