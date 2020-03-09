<?php


namespace MMPBasiq\Entities;

class ExpenseCategoryCode
{
    public $classCode;
    public $classTitle;
    public $groupCode;
    public $groupTitle;
    public $subDivisionCode;
    public $subDivisionTitle;
    public $divisionCode;
    public $divisionTitle;

    public function __construct($body)
    {
        $this->classCode = isset($body['classCode']) ? $body['classCode'] : null;
        $this->classTitle = isset($body['classTitle']) ? $body['classTitle'] : null;

        $this->groupCode = isset($body['groupCode']) ? $body['groupCode'] : null;
        $this->groupTitle = isset($body['groupTitle']) ? $body['groupTitle'] : null;

        $this->subDivisionCode = isset($body['subDivisionCode']) ? $body['subDivisionCode'] : null;
        $this->subDivisionTitle = isset($body['subDivisionTitle']) ? $body['subDivisionTitle'] : null;

        $this->divisionCode = isset($body['divisionCode']) ? $body['divisionCode'] : null;
        $this->divisionTitle = isset($body['divisionTitle']) ? $body['divisionTitle'] : null;
    }
}
