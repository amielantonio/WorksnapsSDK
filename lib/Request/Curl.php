<?php


namespace Worksnaps\Request;


class Curl{


    /*
     * Sets the Curl options
     */
    private $curl_options;

    /*
     * Given endpoint to send the curl request.
     */
    private $endpoint;

    /*
     * Token for accessing request
     */
    private $token;

    /*
     * Get the http response code
     */
    private $http_code;

    /*
     * Store the response to the Curl Response
     */
    public $response;


    /**
     * Curl constructor.
     */
    public function __construct( $endpoint, $token ) {

        $curl_options = require "/../Config/CurlConfig.php";

        $this->curl_options = $curl_options;

        $this->endpoint = $endpoint;

        $this->token = $token;

    }

    /**
     * Do a Curl Request to the endpoint
     *
     * @param $endpoint
     * @param $verb
     */
    public function doCurl( $verb, $data = [] ){

        //Start cUrl to get the data
        $ch = curl_init();

        if( curl_exec( $ch ) === false ) {
            curl_error( $ch );
        }

        curl_setopt_array( $ch, $this->curl_options );
        curl_setopt( $ch, CURLOPT_URL, $this->endpoint );
        curl_setopt( $ch, CURLOPT_POST, $this->parseVerb( $verb ) );
        curl_setopt( $ch, CURLOPT_USERPWD, $this->token );

        //Set Post fields for none GET requests
        if( $verb <> 'get'){
            $data = json_encode( $data );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
        }

        $this->response = curl_exec( $ch );
        $this->http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

        curl_close( $ch ); // close cURL resource
    }

    /**
     * Add new option for Curl
     *
     * @param array $options
     */
    public function setOption( $options = [] ){

        $this->curl_options = array_merge( $this->curl_options, $options);

    }

    /**
     * @return mixed
     */
    public function getOption(){
        return $this->curl_options;
    }

    /**
     * Parse verb to set the post value for curl
     *
     * @param $verb
     * @return int
     */
    private function parseVerb( $verb ){

        switch( $verb ){

            case 'get' :

                return 0; break;

            case 'post' :

                return 1; break;

            case 'put' :

                return 1; break;

            case 'patch' :

                return 1; break;

            case 'delete' :

                return 1; break;
            default :
                return 0; break;
        }

    }



}