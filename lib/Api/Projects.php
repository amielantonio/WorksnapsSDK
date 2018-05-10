<?php

namespace Worksnaps\Api;


use Worksnaps\Core\Worksnaps;
use Worksnaps\Request\HTTPRequests as Request;

class Projects extends Worksnaps {

    private $projectsEndpoint = '/projects.xml';

    private $projectEndpoint = '/projects/{id}.xml';

    //Implement Parent Constructor Class
    public function __construct($token)
    {
        parent::__construct($token);
    }


    /**
     * Get Projects from Worksnaps
     *
     * @return mixed
     */
    public function getProjects(){

        $request = new Request( $this->projectsEndpoint, $this->token);

        return $request->get();

    }

    /**
     *
     *
     * @param $projectID
     * @return mixed
     */
    public function getProject( $projectID ){

        $request = new Request( $this->projectEndpoint, $this->token );

        return $request->getById( $projectID );

    }

    public function saveProject( $data ){

    }


    public function updateProject(){

    }




}
