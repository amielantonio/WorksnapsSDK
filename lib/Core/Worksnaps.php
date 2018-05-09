<?php

namespace App\Services;



class Worksnaps {


    /*-----------------------------------------------------------
     * Worksnaps Web service API token
     *-----------------------------------------------------------
     *
     * This token is used to access your Worksnaps data
     *
     * You can generate your own token by going to your account :
     * profile & settings > Web Service Api > show my Api Token
     *
     */
    private $token;


    private $project;

    private $task;

    private $assignment;

    private $timeentry;

    private $project_report;

    private $summary_report;


    /**
     * variable that contains the array of projects to be
     * used for reporting
     *
     * @array
     */
    private $project_collection = [];

    /**
     * Worksnaps API entry point Url
     *
     * @var string
     */
    private $request_uri = 'http://api.worksnaps.com/api';


    public function __construct( $token ){

        //Set Token to start worksnaps API
        $this->token = $token;

    }


    /**
     * Returns the projects of the account
     */
    public function get_projects(){


        //Set Project Entry Point
        $entry_point = "/projects.xml";

        //Set Main Entry Point
        $endpoint = $this->request_uri . $entry_point;


        // Check if there is a session created


        $projects = $this->get( $endpoint );




    }



    /**
     * Sets the application to use secured HTTP
     */
    public function use_https(){

        $this->request_uri = 'http://api.worksnaps.com/api';

    }

    /**
     * Sets the application to use HTTP only
     */
    public function use_http(){

        $this->request_uri = 'http://api.worksnaps.com/api';

    }

    private function parse_xml( $data ){

        $p = xml_parser_create();

        xml_parse_into_struct( $p, $data, $value, $index );
        xml_parser_free($p);

        return  $value;

    }


    private function get( $endpoint ){

        //Start cUrl to get the data
        $ch = curl_init();

        if( curl_exec( $ch ) === false ) {

            $this->err =  curl_error( $ch );

        }


        curl_setopt( $ch, CURLOPT_URL, $endpoint );
        curl_setopt( $ch, CURLOPT_USERPWD, $this->token );
        curl_setopt( $ch, CURLOPT_POST, 0 );

        curl_close( $ch ); // close cURL resource

        return curl_exec( $ch );

    }

    private function post(){

    }

    private function put(){

    }

    private function delete(){

    }








}