<?php

namespace MMPBasiq\Exceptions;

use Exception;

class HttpResponseException extends Exception
{
    public $response;
    public $statusCode;
    public $message;

    public function __construct($body, $statusCode)
    {
        parent::__construct();
        if (isset($body["data"])) {
            $error = trim(array_reduce($body["data"], function ($sum, $error) {
                return $sum.$error['detail'];
            }, ""));
        } else {
            $error = "Unexpected error from server";
        }

        $this->response = $body;
        $this->statusCode = $statusCode;
        $this->message = $error;
    }
}
