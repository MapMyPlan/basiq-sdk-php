<?php

namespace MMPBasiq\Entities;

use MMPBasiq\Exceptions\BasiqJobFailed;
use MMPBasiq\Exceptions\BasiqJobTimeoutException;
use MMPBasiq\Services\ConnectionService;

class Job extends Entity
{
    private $service;

    public $created;
    public $updated;
    public $steps;
    public $links;

    public function __construct(ConnectionService $service, $data)
    {
        $this->id = $data["id"];
        $this->created = isset($data["created"]) ? new \DateTime($data["created"]) : null;
        $this->updated = isset($data["updated"]) ? new \DateTime($data["updated"]) : null;
        $this->steps = isset($data["steps"]) ? (array) $data["steps"] : [];
        $this->links = isset($data["links"]) ? $data["links"] : [];
        $this->service = $service;
    }

    public function getConnectionId()
    {
        if (count($this->links) === 0 || !isset($this->links["source"])) {
            return "";
        }

        return substr($this->links["source"], strrpos($this->links["source"], "/") + 1);
    }

    public function getConnection()
    {
        if (count($this->links) === 0 || !isset($this->links["source"])) {
            $job = $this->service->getJob($this->id);

            $connectionId = $job->getConnectionId();
        } else {
            $connectionId = $this->getConnectionId();
        }

        return $this->service->get($connectionId);
    }

    public function waitForCredentials($interval, $timeout)
    {
        $start = time();

        while (true) {
            $job = $this->service->getJob($this->id);

            if (time() - $start > $timeout) {
                throw new BasiqJobTimeoutException('Connection');
            }
            $step = $this->getJobStepByTitle($job, 'verify-credentials');
            if ($step["status"] === "success") {
                return $this->service->get($job->getConnectionId());
            }
            if ($step["status"] === "failed") {
                throw new BasiqJobFailed('Verify credentials');
            }

            sleep($interval / 1000);
        }
    }

    public function waitForTransactions($interval, $timeout)
    {
        $start = time();

        while (true) {
            $job = $this->service->getJob($this->id);


            if (time() - $start > $timeout) {
                throw new BasiqJobTimeoutException('Transaction');
            }
            $step = $this->getJobStepByTitle($job, 'retrieve-transactions');
            if ($step["status"] === "success") {
                return $this->service->get($job->getConnectionId());
            }
            if ($step["status"] === "failed") {
                throw new BasiqJobFailed('Retrieve transactions');
            }
            sleep($interval / 1000);
        }
    }

    public function waitForAccounts($interval, $timeout)
    {
        $start = time();
        while (true) {
            $job = $this->service->getJob($this->id);
            if (time() - $start > $timeout) {
                throw new BasiqJobTimeoutException('Accounts');
            }
            $step = $this->getJobStepByTitle($job, 'retrieve-accounts');
            if ($step['status'] === 'success') {
                return $this->service->get($job->getConnectionId());
            }
            if ($step['status'] === 'failed') {
                throw new BasiqJobFailed('Retrieve accounts');
            }
            sleep($interval / 1000);
        }
    }

    protected function getJobStepByTitle(Job $job, string $title): array
    {
        $steps = $job->steps;
        $steps = array_filter($steps, function ($value) use ($title) {
            return $value['title'] == $title;
        });
        return !empty($steps) ? reset($steps) : [];

    }
}