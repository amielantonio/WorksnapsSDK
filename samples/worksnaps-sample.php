<?php


require_once '../vendor/autoload.php';


//LHKjhf9yNXFZMAnV0Db33f7uD28rxeITgEjES5nE



/*
 * Getting Projects
 *
 * $project = ( new Worksnaps( $token ) )->getProject()
 *
 */

use App\Api\Projects;


$projects = new Projects( 'LHKjhf9yNXFZMAnV0Db33f7uD28rxeITgEjES5nE' );


var_dump( $projects->getProjects() );