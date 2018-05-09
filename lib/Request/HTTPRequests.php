<?php


namespace App\Request;


class HTTPRequests {


    private $response;

    private $status_code;

    private $output;


    private $endpoint;

    private $http = "";


    private $token;


    public function __construct( $endpoint, $token ){


        //Create the Endpoint
        $this->endpoint = $endpoint;

        $this->token = $token;

    }


    public function get(){

        //Start cUrl to get the data
        $ch = curl_init();

        if( curl_exec( $ch ) === false ) {

            $this->err =  curl_error( $ch );

        }

        curl_setopt( $ch, CURLOPT_URL, $this->endpoint );
        curl_setopt( $ch, CURLOPT_USERPWD, $this->token );
        curl_setopt( $ch, CURLOPT_POST, 0 );

        $response = curl_exec( $ch );

        curl_close( $ch ); // close cURL resource

        return $response;

    }

    public function post( $data ){

    }

    public function put( $data ){

    }

    public function delete( $id ){

    }

    private function buildEndpoint(){

    }


    private function xmlToJSON(){

    }

    private function use_https(){



    }


}