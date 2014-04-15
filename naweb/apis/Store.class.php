<?php
include_once ("Common.class.php");
//include_once ("../lib/utils.php");
class Store
{
    function call_api(
        $http_method,
        $request,
        $path, 
        $token=True, 
        $payload, 
        $headers, 
        $timeout=10, 
        $response_type='json'//, 
        //$entry_point=settings.STORE_ENTRY_POINT
    ){
        $auth_token = null;
        if( $token ){
            $auth_token = $cache.get(get_cache_slug()."token");
            $logger->debug( "store use token" );
            $token = $cache->get( get_cache_slug()."token");
            $token = base64_decode($token);
        }
        //uri = g.conf['storefront'] + entry_point
        $uri="https://staging-store.sd-ngp.net/api/v1";
        $call = new Common();
        return $call->_make_call(
            $uri, 
            $http_method, 
            $request, 
            $path, 
            $token=$auth_token, 
            $payload, 
            $timeout, 
            $headers, 
            $response_type
        );
    }

    function initial_setup(){
        $payload = array(
            //'os' => g.conf['os'],
            'os' => "Silverlight",
            //'application_name': g.conf['appname'],
            'application_name' => "Lionsgate",
            'format'=> 'json', 
            'evelvated'=> False, 
            'make' => "LG",
            'model'=> "Nexus 4", 
            'version' => 4.3, 
            "device" => "mako",
            "brand" => "google"
        );
        $path = "/identity/initial_setup/";

        $response = $this->call_api(
            "GET", 
            $request="",  //not in use?
            $path,
            null, //token
            $payload,
            $token = false,
            null,
            null,
            null,
            null
        );

        return build_response($response);
// this result has status, 
        //body

    }

}