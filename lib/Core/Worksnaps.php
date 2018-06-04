<?php

namespace Worksnaps\Core;


abstract class Worksnaps {


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
    protected $token;

    /**
     * Worksnaps constructor.
     *
     * @param $token
     */
    protected function __construct( $token ){

        //Set Token to start worksnaps API
        $this->token = $token;

    }






}