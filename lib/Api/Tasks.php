<?php

namespace Worksnaps\Api;

use Worksnaps\Core\Worksnaps;
use Worksnaps\Request\HTTPRequests as Request;

/**
 * Class Tasks
 *
 * @package Worksnaps\Api
 */
class Tasks extends Worksnaps{


    private $tasksEndpoint = "/projects/{project_id}/tasks.xml";


    private $projectTasksEndpoint = "/projects/{project_id}/tasks/{task_id}.xml";


    /**
     * {@inheritdoc}
     */
    public function __construct($token)
    {
        parent::__construct($token);
    }


    public function getTasks( $projectID, $taskID = '' ){

        $request = new Request( $this->tasksEndpoint, $this->token );

        return $request->get();

    }

    public function createTask( $data ){



    }

    public function updateTask( $projectID, $taskID, $data ){

    }

    public function deleteTask( $projectID, $taskID){

    }

}