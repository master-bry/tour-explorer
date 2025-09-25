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
            $redirectTo = session()->get('is_admin') ? '/admin' : '/';
            return redirect()->to($redirectTo);
        }

        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            
            if (empty($email) || empty($password)) {
                return redirect()->back()->with('error', 'Email and password are required.');
            }
            
            $db = db_connect();
            $user = $db->table('users')
                      ->where('email', $email)
                      ->get()
                      ->getRowArray();
            
            if ($user && password_verify($password, $user['password'])) {
                session()->set([
                    'is_logged_in' => true,
                    'is_admin' => ($user['role'] === 'admin'),
                    'user_id' => $user['id'],
                    'user_email' => $user['email'],
                    'username' => $user['username']
                ]);
                
                return redirect()->to('/admin')->with('success', 'Login successful!');
            } else {
                return redirect()->back()->with('error', 'Invalid email or password.');
            }
        }

        return view('auth/login', ['title' => 'Login - Tour Explorer Tz']);
    }

    public function register()
    {
        // Check if already logged in
        if (session()->get('is_logged_in')) {
            return redirect()->to('/');
        }

        if ($this->request->getMethod() === 'post') {
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $confirm_password = $this->request->getPost('confirm_password');
            
            if (empty($name) || empty($email) || empty($password)) {
                return redirect()->back()->with('error', 'All fields are required.');
            }
            
            if ($password !== $confirm_password) {
                return redirect()->back()->with('error', 'Passwords do not match.');
            }
            
            $db = db_connect();
            
            // Check if email exists
            $existing = $db->table('users')
                          ->where('email', $email)
                          ->countAllResults();
            
            if ($existing > 0) {
                return redirect()->back()->with('error', 'Email already registered.');
            }
            
            $userData = [
                'username' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => 'user',
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            if ($db->table('users')->insert($userData)) {
                return redirect()->to('/auth/login')->with('success', 'Registration successful! Please login.');
            } else {
                return redirect()->back()->with('error', 'Registration failed.');
            }
        }

        return view('auth/register', ['title' => 'Register - Tour Explorer Tz']);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Logged out successfully!');
    }
}