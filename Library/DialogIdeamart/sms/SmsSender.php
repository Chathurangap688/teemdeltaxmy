<?php

namespace Dialog\Ideamart\SMS;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

class SmsSender{
    var $server;

    public function __construct($server){
        $this->server = $server; // Assign server url
    }

    /*
        Get parameters form the application
        check one or more addresses
        Send them to smsMany
    **/

    public function sms($message, $addresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header){
        if (is_array($addresses)) {
            return $this->smsMany($message, $addresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header);
        } else if (is_string($addresses) && trim($addresses) != "") {
            return $this->smsMany($message, array($addresses), $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header);
        } else {
            throw new \Exception("address should a string or a array of strings");
        }
    }

    /*
        Get parameters form the sms
        Assign them to an array according to json format
        encode that array to json format
        Send json to sendRequest
    **/

    private function smsMany($message, $addresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header){

        $arrayField = array("applicationId" => $applicationId,
            "password" => $password,
            "message" => $message,
            "deliveryStatusRequest" => $deliveryStatusRequest,
            "destinationAddresses" => $addresses,
            "sourceAddress" => $sourceAddress,
            "chargingAmount" => $charging_amount,
            "encoding" => $encoding,
            "version" => $version,
            "binaryHeader" => $binary_header);

        return $this->sendRequest($arrayField);
    }

    /*
        Get the json request from smsMany
        use curl methods to send sms
        Send the response to handleResponse
    **/

    private function sendRequest($jsonObjectFields){
        try{
            $client = new Client();
            $res = $client->post($this->server, [RequestOptions::JSON => $jsonObjectFields]);
        }catch (RequestException $e){
            return $e->getMessage();
        }

        return $res->getBody();
    }
}



?>