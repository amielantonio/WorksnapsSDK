<?php

namespace Worksnaps\Validator;


/**
 * Class UrlValidator
 *
 * @package Worksnaps\Validator
 */
class UrlValidator{


    /**
     * @param $url
     * @return bool
     */
    public static function validate( $url ){

        if ( ! filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        return true;

    }

}