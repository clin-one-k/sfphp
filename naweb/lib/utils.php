<?php
include_once ( "phputils.php" );
$cache = new Cache(); 

function get_cache(){
    global $cache;
    return $cache->getAll();
}

function get_cache_slug(){
    //need g.conf
    //return "%s%s"."Lionsgate"."Silverlight";
    return "Lionsgate"."Silverlight";
}

// php get response code from CURL, differnet from Python.
function build_response( $response ){
    $ret = array();
    //$ret = getHttpCode($response, CURLINFO_HTTP_CODE);
    $bod = getResponseBody( $response );
    if( $bod ){
    	$ret = $bod;
    }
    return $ret;
}
// wrote this for php .
function getResponseBody( $res ){
	$ary = explode( "\r\n\r\n", $res );

	$body = $ary[count($ary)-1]; //only get the last one
	$r=json_decode ( $body );
            // there is always only one result
    return $r;
}

function set_session_details($resp){
    global $cache;
    $names=get_object_vars($resp); // get key name

    //var_dump($names);
    $action = key($names);
    echo "<br/>Action name: ".$action;
    switch ( $action ) {
        case "initial_setup":
            foreach( $resp -> initial_setup -> configuration AS $key => $value){
                $_SESSION[ $key ] = $value;
                
            }
            $cache->set( 
                get_cache_slug()."token", 
                $resp->initial_setup->auth_token, 
                null //time out
            );
            //var_dump($_SESSION);
            //need log
            break;
        case "authenticate":
            break;
        case "token_exchange":
            break;
        case "internal_error_code":
            break;
        default: 

    }
}
