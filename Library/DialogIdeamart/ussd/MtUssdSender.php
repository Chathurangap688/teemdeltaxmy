<?php
/**
 *   (C) Copyright 1997-2013 hSenid International (pvt) Limited.
 *   All Rights Reserved.
 *
 *   These materials are unpublished, proprietary, confidential source code of
 *   hSenid International (pvt) Limited and constitute a TRADE SECRET of hSenid
 *   International (pvt) Limited.
 *
 *   hSenid International (pvt) Limited retains all title to and intellectual
 *   property rights in these materials.
 */

namespace Dialog\Ideamart\USSD;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

class MtUssdSender{
    var $server;

    public function __construct($server){
        $this->server = $server; // Assign server url
    }

    public function ussd($applicationId, $password, $version, $responseMsg,
                         $sessionId, $ussdOperation, $destinationAddress, $encoding, $chargingAmount){
        if (is_array($destinationAddress)) { //Check destination address is a array or not
            return $this->ussdMany($applicationId, $password, $version, $responseMsg,
                $sessionId, $ussdOperation, $destinationAddress, $encoding, $chargingAmount);
        } else if (is_string($destinationAddress) && trim($destinationAddress) != "") {
            return $this->ussdMany($applicationId, $password, $version, $responseMsg,
                $sessionId, $ussdOperation, $destinationAddress, $encoding, $chargingAmount);
        } else {
            throw new \Exception("address should a string or a array of strings");
        }
    }

    /*
        Get parameters form the ussd
        Assign them to an array according to json format
        encode that array to json format
        Send json to sendRequest
    **/

    private function ussdMany($applicationId, $password, $version, $message,
                              $sessionId, $ussdOperation, $destinationAddress, $encoding, $chargingAmount){

        $arrayField = array("applicationId" => $applicationId,
            "password" => $password,
            "message" => $message,
            "destinationAddress" => $destinationAddress,
            "sessionId" => $sessionId,
            "ussdOperation" => $ussdOperation,
            "encoding" => $encoding,
            "version" => $version,
            "chargingAmount" => $chargingAmount);

        return $this->sendRequest($arrayField);
    }

    /*
        Get the json request from ussdMany
        use curl methods to send Ussd
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


