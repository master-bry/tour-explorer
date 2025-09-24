<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;

class Contact extends Controller
{
    public function index()
    {
        // Display contact form
        if ($this->request->getMethod() === 'get') {
            return view('contact');
        }

        // Process contact form submission
        if ($this->request->getMethod() === 'post') {
            $validation = Services::validation();
            
            $validation->setRules([
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email',
                'message' => 'required|min_length[10]|max_length[1000]',
                'privacy' => 'required'
            ], [
                'name' => [
                    'required' => 'Please enter your name.',
                    'min_length' => 'Name must be at least 3 characters long.'
                ],
                'email' => [
                    'required' => 'Please enter your email address.',
                    'valid_email' => 'Please enter a valid email address.'
                ],
                'message' => [
                    'required' => 'Please enter your message.',
                    'min_length' => 'Message must be at least 10 characters long.'
                ],
                'privacy' => [
                    'required' => 'You must agree to the privacy policy.'
                ]
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            // Here you would typically send an email or save to database
            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'message' => $this->request->getPost('message'),
                'ip_address' => $this->request->getIPAddress(),
                'created_at' => date('Y-m-d H:i:s')
            ];

            // For now, we'll just show a success message
            session()->setFlashdata('success', 'Thank you for your message! We will get back to you soon.');
            return redirect()->to('/contact');
        }
    }
}