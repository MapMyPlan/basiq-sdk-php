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
        $hec = $body['hec'];
        if (isset($hec['class'])) {
            $this->class = new ExpenseCategoryCode($hec['class']);
        } else {
            $this->class = null;
        }
        if (isset($hec['group'])) {
            $this->group = new ExpenseCategoryCode($hec['group']);
        } else {
            $this->group = null;
        }
        if (isset($hec['subDivision'])) {
            $this->subDivision = new ExpenseCategoryCode($hec['subDivision']);
        } else {
            $this->subDivision = null;
        }
        if (isset($hec['division'])) {
            $this->division = new ExpenseCategoryCode($hec['division']);
        } else {
            $this->division = null;
        }
        $changeHistory = [];
        foreach ($body['changeHistory'] as $item) {
            array_push($changeHistory, new AffordabilityExpensePaymentChangeHistory($item));
        }
    }
}
