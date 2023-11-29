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
        echo "aqui funcion  clase task";
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
        // Lee el contenido actual del archivo JSON
        $jsonContent = file_get_contents($this->jsonPath);

        // Decodifica el archivo JSON en un array de objetos Task
        $tasks = json_decode($jsonContent, true, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        // Encuentra el índice de la tarea a extraer
        $taskIndex = -1;
        $i = 0;
        do {
            if ($tasks[$i]['task_id'] == $task_id) {
                $taskIndex = $i;
            }
            $i++;
        } while ($i < count($tasks) && $taskIndex === -1);

        // Si se encuentra la tarea a extraer, devuelve el array
        if ($taskIndex !== -1) {
            return $tasks[$taskIndex];
        } else {
            //throw new Exception("Tarea con ID $task_id no encontrada");
            return "Task not found";
        }
    }

/*    public function deleteTask($task_id)
    {
        // Lee el contenido actual del archivo JSON
        $jsonContent = file_get_contents($this->jsonPath);
    
        // Decodifica el archivo JSON en un array de objetos Task
        $tasks = json_decode($jsonContent, true, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    
        // Encuentra el índice de la tarea a eliminar
        $taskIndex = -1;
        $i = 0;
        while ($i < count($tasks) && $taskIndex === -1) {
            if ($tasks[$i]['task_id'] == $task_id) {
                $taskIndex = $i;
            }
            $i++;
        }
    
        // Si se encuentra la tarea a eliminar, elimínala del array
        if ($taskIndex !== -1) {
            // Elimina la tarea del array
            array_splice($tasks, $taskIndex, 1);
    
            // Codifica el array de objetos Task de vuelta a JSON
            $newJsonContent = json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    
            // Escribe el nuevo contenido en el archivo JSON
            file_put_contents('../db/dataBase.json', $newJsonContent);
        } else {
            //throw new Exception("Tarea con ID $task_id no encontrada");
            return "Task not found";

        }
    }*/
    
    public function deleteTask($task_id)
    {
        // Lee el contenido actual del archivo JSON
        $jsonContent = file_get_contents($this->jsonPath);
    
        // Decodifica el archivo JSON en un array de objetos Task
        $tasks = json_decode($jsonContent, true, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    
        // Encuentra el índice de la tarea a eliminar
        $taskIndex = -1;
        $i = 0;
        while ($i < count($tasks) && $taskIndex === -1) {
            if ($tasks[$i]['task_id'] == $task_id) {
                $taskIndex = $i;
            }
            $i++;
        }
    
        // Si se encuentra la tarea a eliminar, elimínala del array
        if ($taskIndex !== -1) {
            // Elimina la tarea del array
            array_splice($tasks, $taskIndex, 1);
    
            // Codifica el array de objetos Task de vuelta a JSON
            $newJsonContent = json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    
            // Escribe el nuevo contenido en el archivo JSON
            file_put_contents('../db/dataBase.json', $newJsonContent);
            return true;
        } else {
            //throw new Exception("Tarea con ID $task_id no encontrada");
            return "Task not found";
        }
    }   
        
}

?>
