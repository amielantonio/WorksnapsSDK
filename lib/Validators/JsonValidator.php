<?php

namespace Worksnaps\Validator;


class JsonValidator{


    public static function validate( $json ){


        @json_decode( $json );



    }

}