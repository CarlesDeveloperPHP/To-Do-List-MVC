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
    $jsonContent = file_get_contents($this->jsonPath);
    $tasks = json_decode($jsonContent, true, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    // Calcula la diferencia de días y asigna el color correspondiente
    foreach ($tasks as &$task) {
        $daysRemaining = $this->calculateDaysRemaining($task['task_deadline']);
        $task['color'] = $this->assignColor($daysRemaining,$task['task_status']);
    }

    return $tasks;
}

private function calculateDaysRemaining($deadline)
{
    $deadlineDate = new DateTime($deadline);
    $currentDate = new DateTime();
    if($deadlineDate < $currentDate ){
        return null;
    }else{
        $difference = $currentDate->diff($deadlineDate);
        return $difference->days; 
    }

}

private function assignColor($daysRemaining,$status)
{
    if($daysRemaining != null){
        if ($daysRemaining > 10 || $status == "Completed") {
            return 'green-200';
        } elseif ($daysRemaining <= 10 && $daysRemaining > 5) {
            return 'yellow-200';
        } elseif ($daysRemaining <= 5 && $daysRemaining >= 1) {
            return 'yellow-500';
        }
    }else{
        return 'red-200';
    }
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

    public function editTask($task_id, $updatedTask)
    {
    // Convert data json file into array     
    $tasks = $this->getAllTasks();
    
    // Get the index of the data corresponding to the task_id
    $taskIndex = $this->getTaskIndexById($task_id);


        // Use the taskIndex to update the task
        $tasks[$taskIndex] = array_merge($tasks[$taskIndex], $updatedTask);
        
        // Encode the array of Task objects back to JSON
        $newJsonData = json_encode($tasks, JSON_PRETTY_PRINT);
        
        // Write the new content to the JSON file
        file_put_contents('../db/dataBase.json', $newJsonData);
    }

    public function getAllTaskStatuses() {
        return [EnumEstado::Pendinng, EnumEstado::In_Progress, EnumEstado::Completed];
    }
    


}


    

    



?>
