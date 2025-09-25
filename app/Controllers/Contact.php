<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;

class Contact extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Contact Us - Tour Explorer Tz'
        ];
        
        return view('contact', $data);
    }

    public function send()
    {
        if ($this->request->getMethod() === 'post') {
            $validation = Services::validation();
            
            $validation->setRules([
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email',
                'message' => 'required|min_length[10]|max_length[1000]'
            ]);

            if ($validation->withRequest($this->request)->run()) {
                // For now, just show success message
                // In production, you'd send an email here
                session()->setFlashdata('success', 'Thank you for your message! We will get back to you soon.');
                return redirect()->to('/contact');
            } else {
                return redirect()->to('/contact')->withInput()->with('errors', $validation->getErrors());
            }
        }
        
        return redirect()->to('/contact');
    }
}