<?php

namespace MMPBasiq\Services;

use MMPBasiq\Entities\Affordability;
use MMPBasiq\Entities\AffordabilityExpense;
use MMPBasiq\Entities\AffordabilityIncome;
use MMPBasiq\Entities\AffordabilitySummary;
use MMPBasiq\Entities\User;
use MMPBasiq\Entities\Job;
use MMPBasiq\Entities\Account;
use MMPBasiq\Entities\Transaction;
use MMPBasiq\Entities\TransactionList;
use MMPBasiq\Entities\TransactionV2;
use MMPBasiq\Entities\TransactionListV2;
use MMPBasiq\Entities\Connection;
use MMPBasiq\Exceptions\BasiqDateValidationException;
use MMPBasiq\Utilities\DateValidator;
use MMPBasiq\Utilities\ResponseParser;
use MMPBasiq\Utilities\FilterBuilder;

class UserService extends Service
{
    public function create($data = [])
    {
        if (!isset($data['email']) && !isset($data['mobile'])) {
            throw new \InvalidArgumentException('No valid parameters provided');
        }

        $data = array_filter($data, function ($key) {
            return $key === 'email' || $key === 'mobile';
        }, ARRAY_FILTER_USE_KEY);

        $response = $this->session->apiClient->post('/users', [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer '.$this->session->getAccessToken()
            ],
            'json' => $data
        ]);

        return (new User($this, ResponseParser::parse($response)));
    }

    public function forUser($id)
    {
        return (new User($this, [
            'id' => $id
        ]));
    }

    public function get($id)
    {
        $response = $this->session->apiClient->get('/users/'.$id, [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer '.$this->session->getAccessToken()
            ]
        ]);

        return (new User($this, ResponseParser::parse($response)));
    }

    public function update($id, $data)
    {
        if (!isset($id)) {
            throw new \InvalidArgumentException('No id provided');
        }

        if (!isset($data)) {
            throw new \InvalidArgumentException('No valid parameters for update provided');
        }

        $data = array_filter($data, function ($key) {
            return $key === 'email' || $key === 'mobile';
        }, ARRAY_FILTER_USE_KEY);

        $response = $this->session->apiClient->post('/users/'.$id, [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer '.$this->session->getAccessToken()
            ],
            'json' => $data
        ]);
        return (new User($this, ResponseParser::parse($response)));
    }

    public function delete($id)
    {
        if (!isset($id)) {
            throw new \InvalidArgumentException('No id provided');
        }

        $response = $this->session->apiClient->delete('/users/'.$id, [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer '.$this->session->getAccessToken()
            ]
        ]);

        return null;
    }

    /**
     * @param $userId
     * @param  null  $accountId
     * @param  FilterBuilder|null  $filter
     * @return array|Account
     * @throws \MMPBasiq\Exceptions\HttpResponseException
     */
    public function getAccounts($userId, $accountId = null, FilterBuilder $filter = null)
    {
        $url = '/users/'.$userId.'/accounts';

        if ($accountId !== null) {
            $url .= '/'.$accountId;
        }

        if ($filter !== null) {
            $url .= '?'.$filter->getFilter();
        }

        $response = $this->session->apiClient->get($url, [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer '.$this->session->getAccessToken()
            ]
        ]);

        $body = ResponseParser::parse($response);

        if (isset($body['data']) && is_array($body['data'])) {
            return array_map(function ($account) {
                return new Account($account);
            }, $body['data']);
        } else {
            return new Account($body);
        }
    }

    public function getTransactions($userId, $transactionId = null, $filter = null, $limit = null)
    {
        $url = '/users/'.$userId.'/transactions';

        if ($transactionId !== null) {
            $url .= '/'.$transactionId;
        }

        if ($filter !== null || $limit !== null) {
            $url .= '?';
        }

        if ($filter !== null) {
            $url .= $filter->getFilter();
        }

        if ($filter !== null && $limit !== null) {
            $url .= '&';
        }

        if ($limit !== null) {
            if ($limit > 500) {
                throw new \Exception('Limit must be a number less than or equal to 500');
            }
            $url .= 'limit='.$limit;
        }

        $response = $this->session->apiClient->get($url, [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer '.$this->session->getAccessToken()
            ]
        ]);

        $body = ResponseParser::parse($response);

        if (isset($body['data']) && is_array($body['data'])) {
            return $this->session->getApiVersion() == '1.0' ? new TransactionList(
                $body,
                $this->session,
                $limit
            ) : new TransactionListV2($body, $this->session, $limit);
        } else {
            return $this->session->getApiVersion() == '1.0' ? new Transaction($body) : new TransactionV2($body);
        }
    }

    public function refreshAllConnections($userId)
    {
        $response = $this->session->apiClient->post('users/'.$userId.'/connections/refresh', [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer '.$this->session->getAccessToken()
            ]
        ]);

        $connectionService = new ConnectionService($this->session, new User($this, ['id' => $userId]));
        $body = ResponseParser::parse($response);

        return array_map(function ($job) use ($connectionService) {
            return new Job($connectionService, $job);
        }, $body['data']);
    }

    public function getAllConnections($connectionService, $user, FilterBuilder $filter = null)
    {
        $url = 'users/'.$user->id.'/connections';

        if ($filter !== null) {
            $url .= '?'.$filter->getFilter();
        }

        $response = $this->session->apiClient->get($url, [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer '.$this->session->getAccessToken()
            ]
        ]);

        $body = ResponseParser::parse($response);

        return array_map(function ($connection) use ($connectionService, $user) {
            return new Connection($connectionService, $user, $connection);
        }, $body['data']);
    }

    public function deleteConnection($connectionId, $userId)
    {
        $url = 'users/'.$userId.'/connections/'.$connectionId;
        $response = $this->session->apiClient->delete(
            $url,
            [
                'headers' => [
                    'Content-type' => 'application/json',
                    'Authorization' => 'Bearer '.$this->session->getAccessToken()
                ]
            ]
        );
        return ($response->getStatusCode() === 204);
    }

    public function createAffordabilitySummary($userId, $fromMonth, $toMonth)
    {
        $validateFromMonth = DateValidator::validate($fromMonth);
        $validateToMonth = DateValidator::validate($toMonth);
        if (!empty($validateFromMonth) || !empty($validateToMonth)) {
            throw new BasiqDateValidationException();
        }
        if (!DateValidator::minPeriod($fromMonth, $toMonth)) {
            throw new BasiqDateValidationException('Min period is 3 months');
        }

        $url = 'users/'.$userId.'/affordability';

        $body = ['fromMonth' => $fromMonth, 'toMonth' => $toMonth];
        $response = $this->session->apiClient->post($url, [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer '.$this->session->getAccessToken()
            ],
            'json' => $body
        ]);

        $body = ResponseParser::parse($response);
        return new Affordability($body);
    }

    public function fetchIncomeSummary($userId, $incomeSummaryLink)
    {
        $explode = explode('/', $incomeSummaryLink);
        $incomeSummaryId = last($explode);
        $url = 'users/'.$userId.'/income/'.$incomeSummaryId;
        $response = $this->session->apiClient->get(
            $url,
            [
                'headers' => [
                    'Content-type' => 'application/json',
                    'Authorization' => 'Bearer '.$this->session->getAccessToken()
                ]
            ]
        );
        $body = ResponseParser::parse($response);
        return new AffordabilityIncome($body);
    }

    public function fetchExpensesSummary($userId, $expenseSummaryLink)
    {
        $explode = explode('/', $expenseSummaryLink);
        $expenseSummaryId = last($explode);
        $url = 'users/'.$userId.'/expenses/'.$expenseSummaryId;
        $response = $this->session->apiClient->get(
            $url,
            [
                'headers' => [
                    'Content-type' => 'application/json',
                    'Authorization' => 'Bearer '.$this->session->getAccessToken()
                ]
            ]
        );
        $body = ResponseParser::parse($response);
        return new AffordabilityExpense($body);
    }
}
