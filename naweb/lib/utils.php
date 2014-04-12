<?php
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

function set_session_detilas($resp){
    $names=get_object_vars($resp);
    //var_dump($names);
    $action = key($names);
    echo "<br/>Action name: ".$action;

}
