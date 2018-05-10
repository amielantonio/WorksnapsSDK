<?php


namespace Worksnaps\Request;

use Worksnaps\Request\Curl;

class HTTPRequests {


    private $response;

    private $response_code;

    private $output;


    private $request_uri = "http://api.worksnaps.com/api";

    private $endpoint;

    private $token;

    private $err;

    /**
     * HTTPRequests constructor.
     *
     * @param $endpoint
     * @param $token
     */
    public function __construct( $endpoint, $token ){


        //Create the Endpoint
        $this->endpoint = $endpoint;

        $this->token = $token;

    }

    /**
     * cURL method to send a get request to the Worksnaps API
     *
     * @return mixed
     */
    public function get(){

        //Start cUrl to get the data
        $ch = curl_init();

        //Get URI
        $endpoint = $this->buildEndpoint();

        if( curl_exec( $ch ) === false ) {
            curl_error( $ch );
        }

        curl_setopt( $ch, CURLOPT_URL, $endpoint );
        curl_setopt( $ch, CURLOPT_USERPWD, $this->token );
        curl_setopt( $ch, CURLOPT_POST, 0 );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        $response = curl_exec( $ch );

        curl_close( $ch ); // close cURL resource

        return $this->xmlToArray( $response );

    }

    /**
     * cURL method to send a get request to the Worksnaps API
     *
     * @param $id
     * @return mixed
     */
    public function getById( $id ){

        //Get URI
        $endpoint = $this->buildEndpoint();

        $endpoint = str_replace( '{id}', $id, $endpoint );

        //Create a Curl Instance
        $curl = new Curl( $endpoint, $this->token );


        //Do a curl to the endpoint
        $curl->doCurl(  'get' );

        //Receive Response
        $response = $curl->response;

        return $this->xmlToArray( $response );

    }

    public function post( $data ){

        $endpoint = $this->buildEndpoint();

        $curl = new Curl( $endpoint, $this->token );


        $data = $this->arrayToXml( $data );

        $curl->doCurl( 'post', $data );





    }

    public function put( $data ){

    }

    public function delete( $id ){

    }

    /**
     * Set the request_uri to use HTTPS protocol
     */
    public function useHttps(){

        $this->request_uri = 'https://api.worksnaps.com/api';

    }

    /**
     * Build the Endpoint before processing the request
     *
     * @return string
     */
    private function buildEndpoint(){

        return $this->request_uri . $this->endpoint;

    }

    /**
     * Method to convert XML response to Array
     *
     * @param $xml
     * @return mixed
     */
    private function xmlToArray( $xml ){

        $xml = simplexml_load_string( $xml );

        $jsonResult = json_encode($xml);

        $result = json_decode( $jsonResult, true );

        return $result;

    }

    /**
     * Method to convert Array to XML format
     *
     * @param $array
     * @return mixed
     */
    private function arrayToXml( $array ){

        $xml = new \SimpleXMLElement( '<root/>' );
        array_walk_recursive( $array, array($xml, 'addChild') );

        return $xml->asXML();

    }

    /**
     * Method to convert XML response to JSON response
     *
     * @param $xml
     * @return string
     */
    private function xmlToJson( $xml ){

        $xml = simplexml_load_string( $xml );

        $jsonResult = json_encode($xml);

        return $jsonResult;

    }


}