<?php


namespace Worksnaps\Request;

use Worksnaps\Request\Curl;
use \SimpleXMLElement as SimpleXML;

class HTTPRequests {


    /**
     *
     * @var
     */
    private $response;

    /**
     *
     * @var
     */
    private $http_code;

    /**
     *
     * @var string
     */
    private $base_uri = "http://api.worksnaps.com/api";

    /**
     *
     * @var
     */
    private $endpoint;

    /**
     *
     * @var
     */
    private $token;

    /**
     * Variable that stores the error of the HTTP Requests
     *
     * @var
     */
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

        //Get URI
        $endpoint = $this->buildEndpoint();

        //Create a Curl Instance
        $curl = new Curl( $endpoint, $this->token );


        //Do a curl to the endpoint
        $curl->doCurl(  'get' );

        //Receive Response
        $response = $curl->response;

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

    /**
     * Send a post request to the server and check whether the response is success or not
     *
     * @param $data
     * @return bool
     */
    public function post( $data ){

        $endpoint = $this->buildEndpoint();

        $curl = new Curl( $endpoint, $this->token );

        $data = $this->arrayToXml( $data );

        $curl->doCurl( 'post', $data );

        return ( $curl->response == 200) ? true : false;

    }

    /**
     * Send a put request to the server
     *
     * @param $id
     * @param $data
     * @return bool
     */
    public function put( $id, $data ){

        $endpoint = $this->buildEndpoint();

        $endpoint = str_replace( '{id}', $id, $endpoint );

        $curl = new Curl( $endpoint, $this->token );

        $curl->doCurl( 'put', $data );

        return ( $curl->response == 200) ? true : false;

    }

    /**
     * Sends a delete request to the server
     *
     * @param $id
     * @return bool
     */
    public function delete( $id ){

        $endpoint = $this->buildEndpoint();

        $endpoint = str_replace( '{id}', $id, $endpoint );

        $curl = new Curl( $endpoint, $this->token );

        $curl->doCurl( 'delete' );

        return ( $curl->response == 200) ? true : false;

    }

    /**
     * Set the base_uri to use HTTPS protocol
     */
    public function useHttps(){

        $this->base_uri = 'https://api.worksnaps.com/api';

    }

    /**
     * Gets the error of the existing request;
     *
     * @return mixed
     */
    public function error(){

        return $this->err;

    }

    /**
     * Get the HTTP response of the request
     *
     * @return mixed;
     */
    public function httpResponse(){

        return $this->http_code;

    }

    /**
     * Build the Endpoint before processing the request
     *
     * @return string
     */
    private function buildEndpoint(){

        return $this->base_uri . $this->endpoint;

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

        $xml = new SimpleXML( '<root/>' );
        array_walk_recursive( $array, array($xml, 'addChild') );

        return $xml->asXML();

    }

}