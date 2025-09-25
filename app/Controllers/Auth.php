<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        // Check if already logged in
        if (session()->get('logged_in')) {
            $redirectTo = session()->get('is_admin') ? '/admin' : '/';
            return redirect()->to($redirectTo);
        }

        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            
            // Basic validation
            if (empty($email) || empty($password)) {
                return redirect()->back()->with('error', 'Email and password are required.');
            }
            
            $db = db_connect();
            
            try {
                // Use Myth:Auth table structure
                $user = $db->table('users')
                          ->where('email', $email)
                          ->where('active', 1) // Only active users
                          ->get()
                          ->getRowArray();
                
                if ($user && password_verify($password, $user['password_hash'])) {
                    session()->set([
                        'logged_in' => true,
                        'user_id' => $user['id'],
                        'user_email' => $user['email'],
                        'username' => $user['username'],
                        'is_admin' => $this->isUserAdmin($user['id'])
                    ]);
                    
                    $redirectTo = session()->get('is_admin') ? '/admin' : '/';
                    return redirect()->to($redirectTo)->with('success', 'Login successful!');
                } else {
                    return redirect()->back()->with('error', 'Invalid email or password.');
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Database error: ' . $e->getMessage());
            }
        }

        return view('auth/login', ['title' => 'Login - Tour Explorer Tz']);
    }

    public function register()
    {
        // Check if already logged in
        if (session()->get('logged_in')) {
            return redirect()->to('/');
        }

        if ($this->request->getMethod() === 'post') {
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $confirm_password = $this->request->getPost('confirm_password');
            
            // Validation
            if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
                return redirect()->back()->with('error', 'All fields are required.');
            }
            
            if (strlen($password) < 6) {
                return redirect()->back()->with('error', 'Password must be at least 6 characters long.');
            }
            
            if ($password !== $confirm_password) {
                return redirect()->back()->with('error', 'Passwords do not match.');
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return redirect()->back()->with('error', 'Please provide a valid email address.');
            }
            
            $db = db_connect();
            
            try {
                // Check if email exists
                $existing = $db->table('users')
                              ->where('email', $email)
                              ->countAllResults();
                
                if ($existing > 0) {
                    return redirect()->back()->with('error', 'Email already registered.');
                }
                
                // Use Myth:Auth table structure
                $userData = [
                    'username' => $name,
                    'email' => $email,
                    'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                    'active' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                if ($db->table('users')->insert($userData)) {
                    $userId = $db->insertID();
                    
                    // Add user to default group (user group)
                    $db->table('auth_groups_users')->insert([
                        'group_id' => 2, // user group
                        'user_id' => $userId
                    ]);
                    
                    return redirect()->to('/auth/login')->with('success', 'Registration successful! Please login.');
                } else {
                    return redirect()->back()->with('error', 'Registration failed. Please try again.');
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Database error: ' . $e->getMessage());
            }
        }

        return view('auth/register', ['title' => 'Register - Tour Explorer Tz']);
    }

    private function isUserAdmin($userId)
    {
        $db = db_connect();
        try {
            $adminCheck = $db->table('auth_groups_users')
                            ->where('user_id', $userId)
                            ->where('group_id', 1) // admin group
                            ->countAllResults();
            
            return $adminCheck > 0;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Logged out successfully!');
    }
}