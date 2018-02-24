<?php

namespace Dialog\Ideamart\CASS;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;


class QueryBalanceSender{
    private $server;

    public function __construct($server){
        $this->server = $server; // Assign server url
    }

    /*
        Get parameters form the application
        check one or more addresses
        Send them to queryBalanceMany
    **/

    public function queryBalance($applicationId, $password, $subscriberId, $paymentInstrumentName, $accountId, $currency){
        if (is_array($subscriberId)) {
            return $this->queryBalanceMany($applicationId, $password, $subscriberId, $paymentInstrumentName, $accountId, $currency);
        } else if (is_string($subscriberId) && trim($subscriberId) != "") {
            return $this->queryBalanceMany($applicationId, $password, $subscriberId, $paymentInstrumentName, $accountId, $currency);
        } else {
            throw new \Exception("address should a string or a array of strings");
        }
    }

    /*
        Get parameters form the queryBalance
        Assign them to an array according to json format
        encode that array to json format
        Send json to sendRequest
    **/

    private function queryBalanceMany($applicationId, $password, $subscriberId, $paymentInstrumentName, $accountId, $currency){

        $arrayField = array("applicationId" => $applicationId, // set the fields as array with parameter fields
            "password" => $password,
            "subscriberId" => $subscriberId,
            "paymentInstrumentName" => $paymentInstrumentName,
            "accountId" => $accountId,
            "currency" => $currency);

        return $this->sendRequest($arrayField);
    }


    private function sendRequest($arrayFields){
        try{
            $client = new Client();
            $res = $client->post($this->server, [RequestOptions::JSON => $arrayFields]);
        }catch (RequestException $e){
            return $e->getMessage();
        }

        return $res;
    }
}

