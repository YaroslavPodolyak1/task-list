<?php

namespace App\Services\Auth;

use App\Services\Validator\BaseValidator;

class AuthFormValidation extends BaseValidator
{
    protected static $rules = [
        'login' => 'required',
        'password' => 'required',
    ];
    protected $messages = [
        'login' => 'Заполните обязательное поле',
        'password' => 'Заполните обязательное поле',
    ];

}