<?php

namespace App\Controllers;

use App\Models\TourModel;
use App\Models\ReviewModel;
use CodeIgniter\Controller;
use Config\Services;

class Admin extends Controller
{
    public function index()
    {
        // Check if user is admin (you might want to use proper authentication)
        if (!session()->get('is_logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/auth/login')->with('error', 'Please login as administrator.');
        }

        $tourModel = new TourModel();
        $reviewModel = new ReviewModel();

        $data = [
            'tours' => $tourModel->findAll(),
            'reviews' => $reviewModel->findAll(),
        ];

        return view('admin/dashboard', $data);
    }

    public function addTour()
    {
        if (!session()->get('is_logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/auth/login')->with('error', 'Please login as administrator.');
        }

        if ($this->request->getMethod() === 'post') {
            $validation = Services::validation();
            
            $validation->setRules([
                'title' => 'required|min_length[5]|max_length[200]',
                'category' => 'required|in_list[Safari,Kilimanjaro,Zanzibar,Cultural]',
                'description' => 'required|min_length[10]',
                'price' => 'required|numeric',
                'itinerary' => 'required',
                'image' => 'permit_empty|valid_url'
            ]);

            if ($validation->withRequest($this->request)->run()) {
                $tourModel = new TourModel();
                
                $data = [
                    'title' => $this->request->getPost('title'),
                    'category' => $this->request->getPost('category'),
                    'description' => $this->request->getPost('description'),
                    'price' => $this->request->getPost('price'),
                    'itinerary' => $this->request->getPost('itinerary'),
                    'image' => $this->request->getPost('image') ?: 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'duration' => $this->request->getPost('duration'),
                    'max_people' => $this->request->getPost('max_people'),
                ];

                if ($tourModel->insert($data)) {
                    session()->setFlashdata('success', 'Tour added successfully!');
                    return redirect()->to('/admin');
                } else {
                    session()->setFlashdata('error', 'Failed to add tour. Please try again.');
                }
            } else {
                session()->setFlashdata('errors', $validation->getErrors());
                return redirect()->back()->withInput();
            }
        }

        return view('admin/add_tour');
    }
}