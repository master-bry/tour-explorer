<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use Myth\Auth\Controllers\AuthController as MythAuthController;

class Auth extends MythAuthController
{
    public function login()
    {
        return parent::login();
    }

    public function register()
    {
        return parent::register();
    }
}