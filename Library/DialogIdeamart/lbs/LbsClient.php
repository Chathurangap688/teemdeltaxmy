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
namespace Dialog\Ideamart\LBS;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

class LbsClient{
    public function __construct(){
        // empty ctor
    }

    public function getResponse(LbsRequest $request){
        try{
            $client = new Client();
            $res = $client->post($request->getServer(), [RequestOptions::JSON => $request->getArray()]);
        }catch (RequestException $e){
            return $e->getMessage();
        }

        return $res;
    }
}
