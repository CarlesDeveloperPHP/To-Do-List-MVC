<?php

/**
 * Base controller for the application.
 * Add general things in this controller.
 */
class ApplicationController extends Controller 
{
    public function getAllTasksAction()
    {

        $allTasks = [];

        $dataJson = new TaskModel();

        $this->view->allTasks = $dataJson->getAllTasks();

        return $allTasks;
    }	

    public function editTaskAction()
    {
        echo "edit!!!!!!!";
        
        
    }
}
