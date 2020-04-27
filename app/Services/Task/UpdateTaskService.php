<?php

namespace App\Services\Task;

use App\Models\Task;

class UpdateTaskService
{
    public function execute(int $taskId, array $data)
    {
        $task = Task::find($taskId);
        if ($task->body !== $data['body']) {
            $task->edited = true;
        }
        $data = array_map('trim', $data);
        $data = array_map('strip_tags', $data);

        $task->fill($data);

        return $task->save();
    }
}