<?php
include_once ("Common.class.php");
class Auth
{
    function call_api(
        $http_method,
        $request,
        $path, 
        $token=True, 
        $payload
    ){
        global $cache;
        global $logger;
        $auth_token = null;
        if( $token ){
            $auth_token = $cache->get(get_cache_slug()."token");
            $logger -> debug( "auth use token" );
            $token = $auth_token;
            $token = base64_decode($token);
            $logger -> debug( $token );
        }
        //uri = g.conf['storefront'] + entry_point
        $uri=$_SESSION[ "auth_service_url" ];


        $call = new Common();
        //$logger->debug( "<br/>token: ".$token );
        return $call->_make_call(
            $uri, 
            $http_method, 
            $request, 
            $path, 
            $auth_token, 
            $payload
        );
    }

    function register_user( $user_name, $password, $attributes ){
        $payload = new stdClass;
        $payload -> emamil = $user_name;
        $payload -> password = $password;
        //$payload = array( "email" => $user_name, "password" => $password ); 
        if( $attributes ){
            $payload[ 'attribute' ] = $attributes;
        }
        $path = "/register";
        $response = $this->call_api( "POST", $request = null, $path, true, $payload );
        return build_response( $response );
    }
}