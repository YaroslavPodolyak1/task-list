<?php

namespace App\Services\Task;

use App\Services\Validator\BaseValidator;

class TaskValidation extends BaseValidator
{
    protected static $rules = [
        'fio' => 'required',
        'email' => 'required|email',
        'body' => 'required|min:6',
    ];
    protected $messages = [
        'fio' => 'Заполните обязательное поле',
        'email:required' => 'Заполните обязательное поле',
        'email:email' => 'Введен не верный электронный адрес',
        'body:required' => 'Заполните обязательное поле',
        'body:min' => 'Число символов должно быть больше шести',
    ];

}