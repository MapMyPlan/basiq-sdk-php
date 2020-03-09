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
    /** @var array  */
    public $liabilities;
    public $incomeLink;
    public $expenseLink;


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

        $liabilities = [];
        $bodyLiabilities = $body['liabilities'];
        if (isset($bodyLiabilities['loan']) && is_array($bodyLiabilities['loan']) && !empty($bodyLiabilities['loan'])) {
            $loans = $bodyLiabilities['loan'];
            foreach ($loans as $loan) {
                $loanObject = new AffordabilityLoanLiabilities($loan);
                array_push($liabilities, $loanObject);
            }
        }
        if (isset($bodyLiabilities['credit']) && is_array($bodyLiabilities['credit']) && !empty($bodyLiabilities['credit'])) {
            $credits = $bodyLiabilities['credit'];
            foreach ($credits as $credit) {
                $creditObject = new AffordabilityCreditLiabilities($credit);
                array_push($liabilities, $creditObject);
            }
        }
        $this->liabilities = $liabilities;
        $this->incomeLink = $body['links']['income'];
        $this->expenseLink = $body['links']['expenses'];
    }
}
