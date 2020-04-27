<?php

namespace App\Controllers;

use App\Models\Task;
use App\Services\Task\ChangeTaskStatus;
use App\Services\Task\CreateTaskService;
use App\Services\Task\TaskValidation;
use App\Services\Task\UpdateTaskService;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class TaskController extends Controller
{
    public function create()
    {
        return $this->render('task-create');
    }

    public function store()
    {
        $data = Arr::only($_POST, ['fio', 'email', 'body']);
        $isValid = (new TaskValidation)->validate($data);
        if (! empty($isValid->firstOfAll())) {
            redirect_back(['errors' => $isValid->firstOfAll(), 'values' => $data], 'data');
        } else {
            if (CreateTaskService::execute($data)) {
                redirect_to('/main/index', ['message' => 'Задание успешно добавлено']);
            }
        }
    }

    public function edit()
    {
        if ((auth()->check() && auth()->hasRole(1))) {
            if (isset($_GET['task'])) {
                $task = Task::find($_GET['task']);
                $task = Arr::except($task->toArray(), ['edited']);

                return $this->render('task-edit', compact('task'));
            }
        } else {
            header("HTTP/1.1 403 Forbidden");

            return redirect_to('/auth/index');
        }
    }

    public function update()
    {
        if ((auth()->check() && auth()->hasRole(1))) {
            $data = Arr::only($_POST, ['fio', 'email', 'body', 'completed']);
            ['id' => $taskId] = Arr::only($_POST, ['id']);
            $isValid = (new TaskValidation)->validate($data);
            if (! empty($isValid->firstOfAll())) {
                redirect_back(['errors' => $isValid->firstOfAll(), 'values' => $data], 'data');
            } else {
                if (UpdateTaskService::execute($taskId, $data)) {
                    redirect_to('/main/index', ['message' => 'Задание успешно обновлено']);
                }
            }
        } else {
            header("HTTP/1.1 403 Forbidden");

            return redirect_to('/auth/index');
        }
    }

    public function changeStatus()
    {
        if ((auth()->check() && auth()->hasRole(1))) {
            ['completed' => $completed] = Arr::only($_POST, ['completed']);
            ['id' => $taskId] = Arr::only($_POST, ['id']);
            if (ChangeTaskStatus::execute($taskId, $completed)) {
                redirect_to('/main/index', ['message' => 'Статус успешно изменен']);
            }
        } else {
            header("HTTP/1.1 403 Forbidden");

            return redirect_to('/auth/index');
        }
    }
}