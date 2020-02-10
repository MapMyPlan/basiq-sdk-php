<?php

namespace MMPBasiq\Entities;

use MMPBasiq\Services\ConnectionService;

class Connection extends Entity
{
    private $user;
    public $status;
    public $lastUsed;
    public $institution;
    public $accounts;
    /**
     * @var ConnectionService
     */
    public $service;

    public function __construct(ConnectionService $service, $user, $data)
    {
        $this->id = $data["id"];
        $this->status = isset($data["status"]) ? (string) $data["status"] : null;
        $this->lastUsed = isset($data["lastUsed"]) ? new \DateTime($data["lastUsed"]) : null;
        $this->institution = isset($data["institution"]) ? $data["institution"] : null;
        $this->accounts = isset($data["accounts"]) ? (array)$data["accounts"] : [];

        $this->user = $user;

        $this->service = $service;
    }

    public function update($data)
    {
        return $this->service->update($this->id, $data);
    }

    public function refresh()
    {
        return $this->service->refresh($this->id);
    }

    public function delete()
    {
        return $this->service->delete($this->id);
    }
}
