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

namespace Dialog\Ideamart\SMS;

class SmsReceiver{
    private $sourceAddress; //Define parameters for receive sms data
    private $message;
    private $requestId;
    private $applicationId;
    private $encoding;
    private $version;

    /*
        decode the json data an get them to an array
        Get data from Json objects
        check the validity of the response
    **/
    public function __construct($array){
        $this->sourceAddress = $array['sourceAddress'];
        $this->message = $array['message'];
        $this->requestId = $array['requestId'];
        $this->applicationId = $array['applicationId'];
        $this->encoding = $array['encoding'];
        $this->version = $array['version'];

        if (!((isset($this->sourceAddress) && isset($this->message)))) {
            throw new \Exception("Some of the required parameters are not provided");
        }
    }

    /*
        Define getters to return receive data
    **/

    public function getResponse(){
        $responses = array("statusCode" => "S1000", "statusDetail" => "Success");

        return $responses;
    }

    public function getAddress(){
        return $this->sourceAddress;
    }

    public function getMessage(){
        return $this->message;
    }

    public function getRequestID(){
        return $this->requestId;
    }

    public function getApplicationId(){
        return $this->applicationId;
    }

    public function getEncoding(){
        return $this->encoding;
    }

    public function getVersion(){
        return $this->version;
    }

}
