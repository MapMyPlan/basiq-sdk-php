<?php

namespace MMPBasiq\Entities;

class TransactionV2 extends Transaction
{
    public $id;
    public $type;
    public $status;
    public $description;
    public $amount;
    public $account;
    public $balance;
    public $class;
    public $institution;
    public $connection;
    public $postDate;
    public $transactionDate;
    public $direction;
    public $subclass;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->type = $data["type"];
    }
}
