<?php

namespace Dialog\Ideamart\CASS;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

class DirectDebitSender{
    private $server;

    public function __construct($server){
        $this->server = $server; // Assign server url
    }

    /*
        Get parameters form the application
        check one or more addresses
        Send them to cassMany
    **/
    public function cass($applicationId, $password, $externalTrxId, $subscriberId, $paymentInstrumentName, $accountId, $currency, $amount){
        if (is_array($subscriberId)) {
            return $this->cassMany($applicationId, $password, $externalTrxId, $subscriberId, $paymentInstrumentName, $accountId, $currency, $amount);
        } else if (is_string($subscriberId) && trim($subscriberId) != "") {
            return $this->cassMany($applicationId, $password, $externalTrxId, $subscriberId, $paymentInstrumentName, $accountId, $currency, $amount);
        } else {
            throw new \Exception("Address should be a string or a array of strings");
        }
    }

    /*
        Get parameters form the cass
        Assign them to an array according to json format
        encode that array to json format
        Send json to sendRequest
    **/

    private function cassMany($applicationId, $password, $externalTrxId, $subscriberId, $paymentInstrumentName, $accountId, $currency, $amount){
        $arrayField = array("applicationId" => $applicationId, // set the fields as an array with parameter fields
            "password" => $password,
            "externalTrxId" => $externalTrxId,
            "subscriberId" => $subscriberId,
            "paymentInstrumentName" => $paymentInstrumentName,
            "accountId" => $accountId,
            "currency" => $currency,
            "amount" => $amount);


        return $this->sendRequest($arrayField);
    }

    /*
        Get the json request from cassMany
        use curl methods to send cass
        Send the response to handleResponse
    **/

    private function sendRequest($arrayField){ //Use curl commands for send json request
        try{
            $client = new Client();
            $res = $client->post($this->server, [RequestOptions::JSON => $arrayField]);
        }catch (RequestException $e){
            return $e->getMessage();
        }

        return $res;
    }
}
