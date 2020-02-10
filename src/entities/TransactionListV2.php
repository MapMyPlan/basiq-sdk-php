<?php

namespace MMPBasiq\Entities;

class TransactionListV2 extends TransactionList
{
    public $data;
    public $links;
    public $session;
    public $limit;

    private function parseData($data)
    {
        return array_map(function ($transaction) {
            return new TransactionV2($transaction);
        }, $data);
    }
}
