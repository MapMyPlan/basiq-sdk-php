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
    /** @var array */
    public $assets;


    public function __construct($body)
    {
        $this->id = $body['id'];
        $this->fromMonth = $body['fromMonth'];
        $this->toMonth = $body['toMonth'];
        $this->generatedDate = $body['generatedDate'];
        $this->summary = new AffordabilitySummary($body['summary']);
        $assets = [];
        foreach ($body['assets'] as $asset) {
            $assetObject = new AffordabilityAssets($asset);
            array_push($assets, $assetObject);
        }
        $this->assets = $assets;
    }
}
