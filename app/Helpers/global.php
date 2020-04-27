<?php

if (! function_exists('redirect_back')) {
    function redirect_back(array $data = [], string $key = 'data')
    {
        if (! empty($data)) {
            $_SESSION[$key] = $data;
        }
        header("Location:{$_SERVER['HTTP_REFERER']}");
    }
}
if (! function_exists('redirect_to')) {
    function redirect_to($uri, array $data = [], string $key = 'data')
    {
        if ($_SESSION['data']) {
            unset($_SESSION['data']);
        }
        if (! empty($data)) {
            $_SESSION[$key] = $data;
        }
        header("Location:{$uri}");
    }
}
if (! function_exists('old')) {
    function old(string $field)
    {
        if ($values = $_SESSION['data']['values']) {
            return $values[$field];
        }
    }
}

if (! function_exists('get_error')) {
    function get_error(string $error)
    {
        if ($errors = $_SESSION['data']['errors']) {
            return $errors[$error];
        }
    }
}

if (! function_exists('auth')) {
    function auth()
    {
        $db = new \PDO('mysql:dbname=todo;host=localhost;charset=utf8mb4', 'root', '');

        return new \Delight\Auth\Auth($db);
    }
}

if (! function_exists('get_response_message')) {
    function get_response_message()
    {
        if ($message = $_SESSION['data']['message']) {
            return $message;
        }
    }
}

