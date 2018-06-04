<?php


require_once '../vendor/autoload.php';


//LHKjhf9yNXFZMAnV0Db33f7uD28rxeITgEjES5nE



/*
 * Getting Projects
 *
 * $project = ( new Worksnaps( $token ) )->getProject()
 *
 */

use Worksnaps\Api\Projects as WorksnapsProject;


$projects = new WorksnapsProject( 'LHKjhf9yNXFZMAnV0Db33f7uD28rxeITgEjES5nE' );


var_dump( $projects->getProjects() );