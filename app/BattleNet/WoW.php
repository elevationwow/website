<?php namespace App\BattleNet;

class WoW {

    private $httpClient;
    private $apiKey;
    private $apiUrl;
    private $requestUrl;
    private $queryString;

    public function __construct($httpClient, $apiUrl, $apiKey, $locale='EN-US', $jsonp=false) {
        $this->httpClient = $httpClient;
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
        $this->locale = $locale;
        $this->jsonp = $jsonp;
        $this->queryString = ['apikey'=>$this->apiKey, 'locale'=>$this->locale];
    }

    public function setLocale($locale) {
        $this->locale = $locale;
        return $this;
    }

    public function character($realm, $name, $fields='') {
        $this->requestUrl = $this->apiUrl . '/character/' . $realm . '/' . $name;
        if(!empty($fields)) $this->queryString['fields'] = $fields;
        return $this->sendRequest();
    }

    public function guild($realm, $name, $fields='') {
        $this->requestUrl = $this->apiUrl . '/guild/' . $realm . '/' . $name;
        if(!empty($fields)) $this->queryString['fields'] = $fields;
        return $this->sendRequest();
    }

    public function achievement($id) {
        $this->requestUrl = $this->apiUrl . '/achievement/' . $id;
        return $this->sendRequest();
    }

    private function sendRequest()
    {
        return $this->httpClient->get($this->requestUrl, ['query'=>$this->queryString, 'verify'=>false])->json();
    }
}

