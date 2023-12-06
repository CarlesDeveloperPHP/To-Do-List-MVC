<?php


class PaginatorModel
{
    public function getTasksByPage($allTasks, $page, $tasksPerPage)
    {
        $startIndex = ($page - 1) * $tasksPerPage;
        $endIndex = $startIndex + $tasksPerPage;

        return array_slice($allTasks, $startIndex, $tasksPerPage);
    }

    public function getTotalPages($allTasks, $tasksPerPage)
    {
        return ceil(count($allTasks) / $tasksPerPage);
    }
}
?>