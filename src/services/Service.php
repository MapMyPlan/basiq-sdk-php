<?php

namespace MMPBasiq\Services;

class Service
{
    public $session;

    public function __construct(\MMPBasiq\Session $session)
    {
        $this->session = $session;
    }
}
