<?php

namespace App\Services\Validator;

use Rakit\Validation\Validator;

abstract class BaseValidator
{
    public function validate(array $data)
    {
        $validator = new Validator();
        self::setMessage($validator);
        $validation = $validator->validate($data, static::$rules);

        return $validation->errors();
    }

    private function setMessage(Validator $validator)
    {
        $validator->setMessages($this->messages);
    }
}