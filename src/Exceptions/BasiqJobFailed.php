<?php


namespace MMPBasiq\Exceptions;

use Exception;

class BasiqJobFailed extends Exception
{
    public $response;
    public $statusCode;
    public $message;

    public function __construct($body = '', $statusCode = 417)
    {
        parent::__construct();
        $prepend = 'Basiq Job ';
        $append = ' Failed';
        $body = $prepend.$body.$append;
        $this->response = $body;
        $this->statusCode = $statusCode;
        $this->message = $body;
    }
}
