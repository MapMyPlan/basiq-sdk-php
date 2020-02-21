<?php


namespace MMPBasiq\Exceptions;

class BasiqDateValidationException extends \Exception
{
    public $response;
    public $statusCode;
    public $message;

    public function __construct($body = '', $statusCode = 400)
    {
        parent::__construct();
        $prepend = 'Basiq Date Validation ';
        $body = $prepend.$body;
        $this->response = $body;
        $this->statusCode = $statusCode;
        $this->message = $body;
    }
}
