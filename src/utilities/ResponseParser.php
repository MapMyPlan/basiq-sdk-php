<?php

namespace MMPBasiq\Utilities;

use MMPBasiq\Exceptions\HttpResponseException;
use Psr\Http\Message\ResponseInterface;

class ResponseParser
{
    public static function parse(ResponseInterface $response)
    {
        $body = $response->getBody();

        if ($body->getSize() > 0) {
            $contents = $body->__toString();
            $body = json_decode($contents, true);
        
            if ($body === null) {
                throw new \Exception("Invalid response received from server. Check log for the response");
            }

            if ($response->getStatusCode() > 299) {
                throw new HttpResponseException($body, $response->getStatusCode());
            }

            return $body;
        }

        return null;
    }
}
