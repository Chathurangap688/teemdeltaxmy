<?php
/**
 * Created by PhpStorm.
 * User: Kasun
 * Date: 2/22/2018
 * Time: 10:03 AM
 */

namespace Dialog\Ideamart\SMS;


class SmsException extends \Exception{ // Sms Exception Handler

    var $code;
    var $response;
    var $statusMessage;

    public function __construct($message, $code, $response = null){
        parent::__construct($message);
        $this->statusMessage = $message;
        $this->code = $code;
        $this->response = $response;
    }

    public function getStatusCode(){
        return $this->code;
    }

    public function getStatusMessage(){
        return $this->statusMessage;
    }

    public function getRawResponse(){
        return $this->response;
    }

}