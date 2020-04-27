<?php

namespace App\Controllers;

use App\Services\Auth\AuthFormValidation;
use App\Services\Auth\AuthService;
use Illuminate\Support\Arr;

class AuthController extends Controller
{
    public function index()
    {
        return $this->render('auth-form');
    }

    public function authorize()
    {
        $data = Arr::only($_POST, ['login', 'password']);

        $isValid = (new AuthFormValidation())->validate($data);
        if (! empty($isValid->firstOfAll())) {
            redirect_back(['errors' => $isValid->firstOfAll(), 'values' => $data], 'data');
        } else {
            if (AuthService::execute($data)) {
                redirect_to('/main/index');
            }
        }
    }

    public function logout()
    {
        try {
            auth()->logOut();

            redirect_to('/main/index');
        } catch (\Exception $exception) {

        }
    }
}