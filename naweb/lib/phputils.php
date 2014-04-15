<?php
class Cache
{
    function get( $key ){
    	return $_SESSION[ $key ];
    }

    function set( $key, $value, $timeout ){
    	$_SESSION[ $key ] = $value;
    	return TRUE;
    }
    function getAll(){
    	return $_SESSION;
    }
}

class Logger
{
	var $logText = "";
	function debug( $message ){
		$this->logText.= "\n".$message;
	}

	function showLog(){
        return $this->logText;
	}
}