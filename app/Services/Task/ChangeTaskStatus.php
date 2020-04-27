<?php

namespace App\Services\Task;

use App\Models\Task;

class ChangeTaskStatus
{
    public function execute(int $taskId, int $status)
    {
        $task = Task::find($taskId);

        $task->completed = $status;

        return $task->save();
    }
}