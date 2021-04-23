<?php

namespace MMPBasiq\Entities;

class TransactionListV2 extends TransactionList
{
    public $data;
    public $links;
    public $session;
    public $limit;

    public function __construct($data, $session, $limit)
    {
        parent::__construct($data, $session, $limit);
        $this->data = $this->parseData($data["data"]);
    }

    private function parseData($data)
    {
        return array_map(function ($transaction) {
            return new TransactionV2($transaction);
        }, $data);
    }
}
