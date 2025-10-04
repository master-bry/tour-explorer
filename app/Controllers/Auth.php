<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        // Check if already logged in
        if (session()->get('logged_in')) {
            $redirectTo = session()->get('is_admin') ? base_url('admin') : base_url();
            return redirect()->to($redirectTo);
        }

        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();

            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]'
            ];

            if (!$this->validate($rules)) {
                return view('auth/login', [
                    'title' => 'Login - Tour Explorer Tz',
                    'validation' => $this->validator
                ]);
            }

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $db = db_connect();

            try {
                $user = $db->table('users')
                          ->where('email', $email)
                          ->where('active', 1)
                          ->get()
                          ->getRowArray();

                if ($user && password_verify($password, $user['password_hash'])) {
                    // Check if user is admin
                    $isAdmin = $db->table('auth_groups_users')
                                 ->where('user_id', $user['id'])
                                 ->where('group_id', 1)
                                 ->countAllResults() > 0;

                    session()->set([
                        'logged_in' => true,
                        'user_id' => $user['id'],
                        'user_email' => $user['email'],
                        'username' => $user['username'],
                        'is_admin' => $isAdmin
                    ]);

                    $redirectTo = $isAdmin ? base_url('admin') : base_url();
                    return redirect()->to($redirectTo)->with('success', 'Login successful!');
                } else {
                    return redirect()->back()
                                   ->withInput()
                                   ->with('error', 'Invalid email or password.');
                }
            } catch (\Exception $e) {
                log_message('error', 'Login error: ' . $e->getMessage());
                return redirect()->back()
                               ->withInput()
                               ->with('error', 'An error occurred. Please try again.');
            }
        }

        return view('auth/login', ['title' => 'Login - Tour Explorer Tz']);
    }

    public function register()
    {
        // Check if already logged in
        if (session()->get('logged_in')) {
            return redirect()->to(base_url());
        }

        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();

            $rules = [
                'name' => 'required|min_length[3]|max_length[30]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'confirm_password' => 'required|matches[password]'
            ];

            $messages = [
                'email' => [
                    'is_unique' => 'This email is already registered.'
                ],
                'confirm_password' => [
                    'matches' => 'Passwords do not match.'
                ]
            ];

            if (!$this->validate($rules, $messages)) {
                return view('auth/register', [
                    'title' => 'Register - Tour Explorer Tz',
                    'validation' => $this->validator
                ]);
            }

            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $db = db_connect();

            try {
                // Insert user
                $userData = [
                    'username' => $name,
                    'email' => $email,
                    'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                    'active' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $db->table('users')->insert($userData);
                $userId = $db->insertID();

                if ($userId) {
                    // Add user to default user group (id = 2)
                    $db->table('auth_groups_users')->insert([
                        'group_id' => 2,
                        'user_id' => $userId
                    ]);

                    log_message('info', 'New user registered: ' . $email . ' (ID: ' . $userId . ')');

                    return redirect()->to(base_url('auth/login'))
                                   ->with('success', 'Registration successful! Please login.');
                }

                return redirect()->back()
                               ->withInput()
                               ->with('error', 'Registration failed. Please try again.');

            } catch (\Exception $e) {
                log_message('error', 'Registration error: ' . $e->getMessage());
                return redirect()->back()
                               ->withInput()
                               ->with('error', 'An error occurred. Please try again.');
            }
        }

        return view('auth/register', ['title' => 'Register - Tour Explorer Tz']);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url())->with('success', 'Logged out successfully!');
    }
}
