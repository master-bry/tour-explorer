<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Myth\Auth\Controllers\AuthController as MythAuthController;

class Auth extends MythAuthController
{
    public function login()
    {
        // If already logged in, redirect to appropriate page
        if (service('auth')->check()) {
            $user = service('auth')->user();
            
            // Check if user is in admin group
            if (service('authorization')->inGroup('admin', $user->id)) {
                return redirect()->to('/admin');
            }
            
            return redirect()->to('/');
        }

        return parent::login();
    }

    public function register()
    {
        // If already logged in, redirect
        if (service('auth')->check()) {
            return redirect()->to('/');
        }

        return parent::register();
    }

    public function logout()
    {
        return parent::logout();
    }
}