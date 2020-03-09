<?php


namespace MMPBasiq\Entities;

class ExpenseCategoryCode
{
    public $code;
    public $title;

    public function __construct($body)
    {
        $this->code = $body['code'];
        $this->title = $body['title'];
    }
}
