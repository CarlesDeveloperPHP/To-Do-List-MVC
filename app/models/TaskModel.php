<?php

class TaskModel
{

    protected $tasks = [];
    protected $jsonPath;


    public function __construct()
    {

        $this->jsonPath = ROOT_PATH . '/db/dataBase.json';// donde está el JSON
    }

    public function getAllTasks()
    {
        $data = file_get_contents($this->jsonPath);
        // El segundo argumento "true" indica que se debe devolver un arreglo asociativo en lugar de un objeto.
        $tasks = json_decode($data, true);
        return $tasks;
    }
    
    public function editTask()
    {
        echo "aqui funcion  clase task";
    }

}
