<?php

namespace Worksnaps\Api;


use Worksnaps\Core\Worksnaps;
use Worksnaps\Request\HTTPRequests as Request;

/**
 * Class Projects
 * @package Worksnaps\Api
 */
class Projects extends Worksnaps {

    private $projectsEndpoint = '/projects.xml';

    private $specificProjectEndpoint = '/projects/{id}.xml';

    /**
     * {@inheritdoc}
     */
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

        $request = new Request( $this->projectsEndpoint, $this->token );

        return $request->get();

    }

    /**
     * Get a specific project from Worksnaps
     *
     * @param $projectID
     * @return mixed
     */
    public function getProject( $projectID ){

        $request = new Request( $this->specificProjectEndpoint, $this->token );

        return $request->getById( $projectID );

    }

    /**
     * Create a new project to worksnaps
     *
     * @param $data
     * @return bool|string
     */
    public function saveProject( $data ){

        $request = new Request( $this->projectsEndpoint, $this->token);

        return ( $request->post( $data ) )? true : "Something unexpected happened";

    }

    /**
     * Updates a specific Project in Worksnaps
     *
     * @param $id
     * @param $data
     * @return bool|string
     */
    public function updateProject( $id, $data){

        $request = new Request( $this->projectEndpoint, $this->token);

        return ( $request->put( $id, $data ) )? true : "Something unexpected happened";

    }

    public function deleteProject( $id ){

        $request = new Request( $this->projectEndpoint, $this->token );

        return ( $request->delete( $id ) )? true : "Something unexpected happened";

    }




}
