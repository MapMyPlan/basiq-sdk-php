<?php


namespace MMPBasiq\Exceptions;

use Exception;

class BasiqJobTimeoutException extends Exception
{
    public $response;
    public $statusCode;
    public $message;

    public function __construct($body = '', $statusCode = 408)
    {
        parent::__construct();
        $prepend = 'Basiq Job ';
        $append = ' Timeout';
        $body = $prepend.$body.$append;
        $this->response = $body;
        $this->statusCode = $statusCode;
        $this->message = $body;
    }
}
