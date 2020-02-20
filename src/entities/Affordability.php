<?php


namespace MMPBasiq\Entities;

class Affordability extends Entity
{
    public $id;
    public $type = 'affordability';
    public $fromMonth;
    public $toMonth;
    public $generatedMonth;
}
