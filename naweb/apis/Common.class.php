<?
class Common{

    function _make_call(
        $uri, 
        $http_method, 
        $request, 
        $path, 
        $token=None, 
        $payload, 
        $timeout=10, 
        $headers=array(), 
        $response_type='json'
    ){
        $url = $uri . $path;

        $headers = array(
            "Content-Type: application/json",
            "User-Agent: com.sdgtl.htc.watch/1.0 (build:4; model:Nexus 4; device:mako; mcc:234; mnc:30; fp:google/occam/mako:4.3/JWR66Y/776638:user/release-keys; cid:"
        );
        
        //echo "<p>method: ".$http_method."</p>";
        //$url.="?".http_build_query($payload);
        //echo "<p>URL: ".$url."</p>";

        switch( $http_method ){
            case "GET":
                $url.="?".http_build_query($payload);
                $curl = curl_init( $url );
                curl_setopt ( $curl, CURLOPT_CUSTOMREQUEST, $http_method);
                break;
            case "POST":
                $curl = curl_init( $url );
                curl_setopt ( $curl, CURLOPT_CUSTOMREQUEST, $http_method);
                curl_setopt ( $curl, CURLOPT_POSTFIELDS, $payload);
                break;
        }        
        curl_setopt ( $curl, CURLOPT_HEADER, true );
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec( $curl );
        //var_dump($curl);
        //echo "<p>";
        //var_dump($response);
        $statusCode = curl_getinfo( $curl, CURLINFO_HTTP_CODE );
        //echo "<p>StatusCode: ".$statusCode."</p>";
        if ( !$response && $statusCode !== 200 ) {
             $response = curl_error ( $curl );
             curl_close ( $curl );
             throw new Exception( "Attempted to make a request to ".$url." but got a ".$statusCode );
        } 

        //$ary= explode ( "\r\n\r\n", $response );
        // take the last part only 
        //$body = $ary[count($ary)-1];
        //$this->success = true;
        //$r=json_decode ( $body );
        // there is always only one result
        //$this->results = $r->results;
        curl_close ( $curl );
        return $response;
    }

}
