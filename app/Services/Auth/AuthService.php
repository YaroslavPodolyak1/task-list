<?php

namespace App\Services\Auth;

use Delight\Auth\AmbiguousUsernameException;

class AuthService
{
    public function execute($data)
    {
        array_map('trim', $data);
        array_map('strip_tags', $data);
        ['login' => $login, 'password' => $password] = $data;
        try {
            auth()->loginWithUsername($login, $password);

            return auth()->check();

        } catch (\Delight\Auth\UnknownUsernameException $e) {
            redirect_back(['errors' => ['login' => 'Введен неверный логин'], 'values' => $data], 'data');
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            redirect_back(['errors' => ['password' => 'Введен неверный пароль'], 'values' => $data], 'data');
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            redirect_back(['errors' => ['too_many_request' => 'Слишком много запросов'], 'values' => $data], 'data');
        } catch (AmbiguousUsernameException $e) {
            redirect_back(['errors' => ['login' => 'Введен неверный логин'], 'values' => $data], 'data');
        }
    }

}