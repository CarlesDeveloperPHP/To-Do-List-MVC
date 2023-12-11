<?php

class TaskModel
{

    protected $tasks = [];
    protected $jsonPath;

    public function __construct()
    {
        $this->jsonPath = ROOT_PATH . '/db/dataBase.json';
    }

    public function getAllTasks()
    {
        $jsonContent = file_get_contents($this->jsonPath);
        $tasks = json_decode($jsonContent, true, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    
        // Calculate the day difference and assign the corresponding color.
        foreach ($tasks as &$task) {
            $daysRemaining = $this->calculateDaysRemaining($task['task_deadline']);
            $task['color'] = $this->assignColor($daysRemaining,$task['task_status']);
        }
    
        return $tasks;
    }
    
    public function getTasksWithColor($tasks)
    {        
        $tasksWithColor = $tasks;    
        // Calculate the day difference and assign the corresponding color.
        foreach ($tasksWithColor as $task) {
            $daysRemaining = $this->calculateDaysRemaining($task['task_deadline']);
            $task['color'] = $this->assignColor($daysRemaining, $task['task_status']);
        }
       
        return $tasksWithColor;
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

    public function searchTasks($taskFilter)
    {
        // Convert data json file into array     
        $tasks = $this->getAllTasks();
        // filter $tasks array based on the conditions of the filter array 
        return array_filter($tasks, function ($task) use ($taskFilter) {
            foreach ($taskFilter as $key => $value) {
                if (!isset($task[$key]) || strtolower($task[$key]) !== strtolower($value)) {
                    return false;
                }
            }
            return true;
        });        
    }


    public function editTask($task_id, $updatedTask)
    {
    // Convert data json file into array     
    $tasks = $this->getAllTasks();
    // Get the index of the data corresponding to the task_id
    $taskIndex = $this->getTaskIndexById($task_id);
    // Use the taskIndex to update the task
    $tasks[$taskIndex] = array_merge($tasks[$taskIndex], $updatedTask);
    //Delete color of all tasks 
    foreach ($tasks as &$task) {
        unset($task['color']);
    }
    // Encode the array of Task objects back to JSON
    $newJsonData = json_encode($tasks, JSON_PRETTY_PRINT);
    // Write the new content to the JSON file
    file_put_contents('../db/dataBase.json', $newJsonData);
    }
}


    

    



?>
