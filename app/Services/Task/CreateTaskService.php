<?php

namespace App\Services\Task;

use App\Models\Task;

class CreateTaskService
{
    public static function execute(array $data)
    {
        $data = array_map('trim', $data);
        $data = array_map('strip_tags', $data);

        $task = new Task($data);

        return $task->save();
    }
}