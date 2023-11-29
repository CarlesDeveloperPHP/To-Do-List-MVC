<?php

/**
 * Base controller for the application.
 * Add general things in this controller.
 */

// The class TaskModel file doesn't need to be imported due to the autoloader
//require_once "../app/models/TaskModel.php";

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

	public function getViewInsertFormAction()
    {   
    }

    public function createTaskAction()
    {
        if (isset($_POST) && !empty($_POST)) {
            
            if ($_POST["task_deadline"] < $_POST["task_startDate"]) {
                $this->view->message = "Deadline cannot be greater than the Start date!!";
                $this->view->txtColor = "text-red-500";
            }
            else{
                // Array where store data collected from the new task creation form
                $newTaskData = array(
                "task_id"=> uniqid(),
                "task_name" => $_POST["task_name"],
                "task_details" => $_POST["task_details"],
                "task_created_by" => $_POST["task_created_by"],
                "task_creation_date" => $_POST["task_startDate"],
                "task_deadline" => $_POST["task_deadline"],
                "task_assigned_to" => $_POST["task_assigned_to"],
                "task_status" => "Pending"
                );
            
            $taskModel = new TaskModel();
            $taskModel->createTask($newTaskData);
            // Success message;
            $this->view->message = "New task created successfully!!";
            $this->view->txtColor = "text-green-500";
            }
        }
        else{
            // Error message;
            $this->view->message = "Error: new task could not be created";
            $this->view->txtColor = "text-red-500";
        }
    }

    public function getViewPreDeleteAction()
    {
        $parameters = $this->_namedParameters;
        $task_id = $parameters["id"];
        $taskModel = new TaskModel();
        $task = $taskModel->getTaskById($task_id);
        if (isset($task) && is_array($task)) {
            $this->view->task_id = $task["task_id"];
            $this->view->message = "You are about to delete the task: " . $task["task_name"];
            $this->view->buttonText="No way!!";
            $this->view->txtColor = "text-lime-600";
        } else {
            $this->view->message = "$task";
            $this->view->buttonText="Show all tasks";
            $this->view->txtColor = "text-red-600";
        }
    }

/*    public function deleteTaskAction()
    {
        $parameters = $this->_namedParameters;
        $task_id = $parameters["id"];
        $taskModel = new TaskModel();
        $taskModel->deleteTask($task_id);
        $this->view->message = "The task has been deleted sucessfully!!";
        $this->view->txtColor = "text-green-600";
    }
*/

    public function deleteTaskAction()
    {
        $parameters = $this->_namedParameters;
        $task_id = $parameters["id"];
        $taskModel = new TaskModel();
        $isDeleted = $taskModel->deleteTask($task_id);
        if ($isDeleted!=true) {
            $this->view->message = "Task not found";
            $this->view->buttonText="Create a new task";
            $this->view->txtColor = "text-red-600";
        } else {
            $this->view->message = "The task has been deleted successfully";
            $this->view->buttonText="Show all tasks";
            $this->view->txtColor = "text-lime-600";
        }
       
    }

}
