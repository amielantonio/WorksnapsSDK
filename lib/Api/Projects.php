<?php

namespace App\Api;


use App\Core\Worksnaps;
use App\Request\HTTPRequests as Request;

class Projects extends Worksnaps {

    private $projectsEndpoint = '/projects.xml';

    private $projectEndpoint = '/projects/{id}.xml';

    //Implement Parent Constructor Class
    public function __construct($token)
    {
        parent::__construct($token);
    }


    public function getProjects(){

        $request = new Request( $this->projectEndpoint, $this->token);

        return $request->get();

    }


}
