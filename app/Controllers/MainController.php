<?php

namespace App\Controllers;

use App\Models\Task;

class MainController extends Controller
{
    public function index()
    {
        $_GET['page'] ? $page = $_GET['page'] : $page = 1;
        $_GET['field'] ? $field = $_GET['field'] : $field = 'id';
        $_GET['sort'] ? $sort = $_GET['sort'] : $sort = 'desc';

        $tasks = Task::orderBy($field, $sort)->get()->forPage(intval($page), 3);
        $totalCount = ceil(Task::all()->count() / 3);

        return $this->render('task-list',
            [
                'tasks' => $tasks,
                'totalCount' => $totalCount,
                'currentPage' => $page,
            ]
        );
    }
}