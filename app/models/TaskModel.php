<?php

class TaskModel
{

    protected $tasks = [];
    protected $jsonPath;

    public function __construct()
    {
        $this->jsonPath = ROOT_PATH . '/db/dataBase.json';// donde está el JSON
    }

    public function editTask()
    {
        echo "Here editTask function";
    }

    public function getAllTasks()
    {
        // $data= file_get_contents('/..app/models/persistencia/DDBB.json') ;
        $jsonContent = file_get_contents($this->jsonPath);
        // The second argument 'true' indicates that an associative array should be returned instead of an object.
        $tasks = json_decode($jsonContent, true, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        return $tasks;
    }
    
    public function createTask($newTaskData)
    {   
        // Convert data json file into array     
        $tasks = $this->getAllTasks();
        // Add new Task object into the array
        $tasks[] = $newTaskData;
        // Encode Task objects array back to JSON
        $newJsonContent = json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        // Write the new content intoto the JSON file
        file_put_contents('../db/dataBase.json', $newJsonContent);
    }

    public function getTaskIndexById($task_id)
    {
        // Convert data json file into array     
        $tasks = $this->getAllTasks();

        // Find the index of the task to extract
        $taskIndex = -1;
        $i = 0;
        do {
            if ($tasks[$i]['task_id'] == $task_id) {
                $taskIndex = $i;
            }
            $i++;
        } while ($i < count($tasks) && $taskIndex === -1);
        
        return $taskIndex;
    }

    public function getTaskById($task_id)
    {
        // Convert data json file into array     
        $tasks = $this->getAllTasks();
        // Get the index of the data corresponding to the task_id
        $taskIndex = $this->getTaskIndexById($task_id);
        // If the task to extract is found, return the array
        if ($taskIndex !== -1) {
            return $tasks[$taskIndex];
        } else {
            return "Task not found";
        }
    }
    
    public function deleteTask($task_id)
    {        
        // Convert data json file into array     
        $tasks = $this->getAllTasks();
        // Get the index of the data corresponding to the task_id
        $taskIndex = $this->getTaskIndexById($task_id);
        // Deleting process
        if ($taskIndex !== -1) {
            array_splice($tasks, $taskIndex, 1);
            // Encode the array of Task objects back to JSON
            $newJsonContent = json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            // Write the new content to the JSON file
            file_put_contents('../db/dataBase.json', $newJsonContent);
            return true;
        } else {
            return false;
        }

    }

}

?>
