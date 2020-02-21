<?php


namespace MMPBasiq\Entities;

class Affordability extends Entity
{
    public $id;
    public $type = 'affordability';
    public $fromMonth;
    public $toMonth;
    public $generatedDate;
    /** @var AffordabilitySummary */
    public $summary;

    public function __construct($body)
    {
        $this->id = $body['id'];
        $this->fromMonth = $body['fromMonth'];
        $this->toMonth = $body['toMonth'];
        $this->generatedDate = $body['generatedDate'];
        $body->summary = new AffordabilitySummary($body['summary']);
    }
}
