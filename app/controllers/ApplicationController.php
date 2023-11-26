<?php

/**
 * Base controller for the application.
 * Add general things in this controller.
 */

// The class TaskModel file doesn't need to be imported due to the autoloader
//require_once "../app/models/TaskModel.php";

class ApplicationController extends Controller 
{
	public function getViewInsertFormAction()
        {   
        }

        public function createTaskAction()
        {

            if (isset($_GET) && !empty($_GET)) {
            
                // Array where store data collected from the new task creation form
                $newTaskData = array(
                    "task_name" => $_GET["task_name"],
                    "task_details" => $_GET["task_details"],
                    "task_created_by" => $_GET["task_created_by"],
                    "task_deadline" => $_GET["task_deadline"],
                    "task_assigned_to" => $_GET["task_assigned_to"],
                );
                
                // Read the current content of the JSON file
                $jsonContent = file_get_contents('../db/dataBase.json');

                // Decode the JSON file into a Task objects array   
                $tasks = json_decode($jsonContent, true, 512, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

                // Create a new Task object with the data to insert
                $newTask = new TaskModel(
                    $newTaskData["task_name"],
                    $newTaskData["task_details"],
                    $newTaskData["task_created_by"],
                    $newTaskData["task_deadline"],
                    $newTaskData["task_assigned_to"],
                );

                // Add new Task object into the array
                $tasks[] = $newTask;

                // Encode Task objects array back to JSON
                $newJsonContent = json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

                // Write the new content intoto the JSON file
                file_put_contents('../db/dataBase.json', $newJsonContent);

                //echo "Success message";

            } else {
                echo "Error: new task could not be created";
            }



        }
}
