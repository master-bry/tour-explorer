<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;

class Auth extends Controller
{
    public function login()
    {
        // Check if already logged in
        if (session()->get('is_logged_in')) {
            return redirect()->to('/admin');
        }

        if ($this->request->getMethod() === 'post') {
            $validation = Services::validation();
            
            // Simple validation
            $validation->setRules([
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]'
            ]);

            if ($validation->withRequest($this->request)->run()) {
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                
                // Simple authentication (replace with database check in production)
                if ($email === 'admin@tourexplorer.tz' && $password === 'admin123') {
                    session()->set([
                        'is_logged_in' => true,
                        'is_admin' => true,
                        'user_email' => $email,
                        'user_id' => 1
                    ]);
                    return redirect()->to('/admin')->with('success', 'Login successful!');
                } else {
                    return redirect()->back()->with('error', 'Invalid email or password');
                }
            } else {
                return redirect()->back()->with('errors', $validation->getErrors());
            }
        }

        $data = [
            'title' => 'Login - Tour Explorer Tz'
        ];
        
        return view('auth/login', $data);
    }

    public function register()
    {
        // Check if already logged in
        if (session()->get('is_logged_in')) {
            return redirect()->to('/admin');
        }

        if ($this->request->getMethod() === 'post') {
            $validation = Services::validation();
            
            // Simple validation
            $validation->setRules([
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]',
                'confirm_password' => 'required|matches[password]'
            ]);

            if ($validation->withRequest($this->request)->run()) {
                // In a real app, you'd save to database here
                // For demo, just redirect to login
                session()->setFlashdata('success', 'Registration successful! Please login.');
                return redirect()->to('/auth/login');
            } else {
                return redirect()->back()->with('errors', $validation->getErrors());
            }
        }

        $data = [
            'title' => 'Register - Tour Explorer Tz'
        ];
        
        return view('auth/register', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Logged out successfully!');
    }
}