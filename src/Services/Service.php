<?php

namespace MMPBasiq\Services;

use MMPBasiq\Session;

class Service
{
    public $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }
}
