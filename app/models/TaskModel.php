<?php

    class TaskModel
    {
        protected $tasks = [];
        protected $jsonPath;

        public function __construct()
        {
            $this->jsonPath = ROOT_PATH . '/db/dataBase.json';// where JSON file is
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
        
    }

?>
