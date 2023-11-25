<?php

    class TaskModel    {
        public $task_id;
        public $task_name;
        public $task_details;
        public $task_created_by;
        public $task_creation_date;
        public $task_deadline;
        public $task_assigned_to;
        public $task_status;

        public function __construct($task_name, $task_details, $task_created_by, $task_deadline, $task_assigned_to)
        {
            $this->task_id = uniqid(); // Automatically generated id
            $this->task_name = $task_name;
            $this->task_details = $task_details;
            $this->task_created_by = $task_created_by;
            $this->task_creation_date =  date('Y-m-d'); // Automatically generated date
            $this->task_deadline = $task_deadline;
            $this->task_assigned_to = $task_assigned_to;
            $this->task_status = "Pending"; // A new task is allways created as pending
        }
    }

?>
