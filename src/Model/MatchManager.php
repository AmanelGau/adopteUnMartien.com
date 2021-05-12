<?php

namespace App\Model;

class MatchManager extends AbstractManager
{
    private array $apiArray = [];
    public function getApiArray($response)
    {
            $this->apiArray[] = $response;
        return $this->apiArray;
    }
    public function getRandomApi()
    {
    }
}
