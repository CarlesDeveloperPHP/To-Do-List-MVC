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
        $data = file_get_contents($this->jsonPath);
        // The second argument 'true' indicates that an associative array should be returned instead of an object.
        $tasks = json_decode($data, true);
        return $tasks;
    }
    
    public function createTask($newTaskData)
    {            
        // Read the current content of the JSON file
        $jsonContent = file_get_contents($this->jsonPath);
        // Decode the JSON file into a Task objects array   
        $tasks = json_decode($jsonContent, true, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        // Add new Task object into the array
        $tasks[] = $newTaskData;
        // Encode Task objects array back to JSON
        $newJsonContent = json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        // Write the new content intoto the JSON file
        file_put_contents('../db/dataBase.json', $newJsonContent);
    }

    public function getTaskById($task_id)
    {
        // Read the current content of the JSON file
        $jsonContent = file_get_contents($this->jsonPath);

        // Decode the JSON file into an array of Task objects
        $tasks = json_decode($jsonContent, true, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        // Find the index of the task to extract
        $taskIndex = -1;
        $i = 0;
        do {
            if ($tasks[$i]['task_id'] == $task_id) {
                $taskIndex = $i;
            }
            $i++;
        } while ($i < count($tasks) && $taskIndex === -1);

        // If the task to extract is found, return the array
        if ($taskIndex !== -1) {
            return $tasks[$taskIndex];
        } else {
            return "Task not found";
        }
    }
    
    public function deleteTask($task_id)
    {
        // Read the current content of the JSON file
        $jsonContent = file_get_contents($this->jsonPath);
    
        // Decode the JSON file into an array of Task objects
        $tasks = json_decode($jsonContent, true, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    
        // Find the index of the task to extract
        $taskIndex = -1;
        $i = 0;
        while ($i < count($tasks) && $taskIndex === -1) {
            if ($tasks[$i]['task_id'] == $task_id) {
                $taskIndex = $i;
            }
            $i++;
        }
    
        // If the task to delete is found, remove it from the array
        if ($taskIndex !== -1) {
            // Remove task from the array tasks
            array_splice($tasks, $taskIndex, 1);
    
            // Encode the array of Task objects back to JSON
            $newJsonContent = json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    
            // Write the new content to the JSON file
            file_put_contents('../db/dataBase.json', $newJsonContent);
            return true;
        } else {
            return "Task not found";
        }
    }        
}

?>
