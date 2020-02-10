<?php

namespace MMPBasiq\Services;

class Service
{
    public $session;

    public function __construct(\Basiq\Session $session)
    {
        $this->session = $session;
    }
}
