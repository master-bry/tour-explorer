<?php

namespace App\Controllers;

use App\Models\TourModel;
use App\Models\ReviewModel;
use CodeIgniter\Controller;
use Config\Services;

class Admin extends Controller
{
    protected $helpers = ['auth', 'authorization'];

    public function index()
    {
        // Myth:Auth filter will handle authentication and authorization
        $tourModel = new TourModel();
        $reviewModel = new ReviewModel();

        $user = service('auth')->user();

        $data = [
            'title' => 'Admin Dashboard - Tour Explorer Tz',
            'tours' => $tourModel->findAll(),
            'reviews' => $reviewModel->findAll(),
            'user' => $user
        ];

        return view('admin/dashboard', $data);
    }

    public function addTour()
    {
        // Myth:Auth filter handles the admin check
        
        if ($this->request->getMethod() === 'post') {
            $validation = Services::validation();
            
            $validation->setRules([
                'title' => 'required|min_length[5]|max_length[200]',
                'category' => 'required|in_list[Safari,Kilimanjaro,Zanzibar,Cultural]',
                'description' => 'required|min_length[10]',
                'price' => 'required|numeric',
                'itinerary' => 'required',
                'image' => 'permit_empty|valid_url_strict'
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
                    return redirect()->to('/admin')->with('success', 'Tour added successfully!');
                } else {
                    return redirect()->back()->with('error', 'Failed to add tour. Please try again.');
                }
            } else {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
        }

        $data = [
            'title' => 'Add New Tour - Admin'
        ];

        return view('admin/add_tour', $data);
    }

    public function editTour($id)
    {
        // Check if user is logged in
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/auth/login')->with('error', 'Please login to access admin area.');
        }

        $tourModel = new TourModel();
        $tour = $tourModel->find($id);

        if (!$tour) {
            return redirect()->to('/admin')->with('error', 'Tour not found.');
        }

        if ($this->request->getMethod() === 'post') {
            $validation = Services::validation();
            
            $validation->setRules([
                'title' => 'required|min_length[5]|max_length[200]',
                'category' => 'required|in_list[Safari,Kilimanjaro,Zanzibar,Cultural]',
                'description' => 'required|min_length[10]',
                'price' => 'required|numeric',
                'itinerary' => 'required',
                'image' => 'permit_empty|valid_url_strict'
            ]);

            if ($validation->withRequest($this->request)->run()) {
                $data = [
                    'title' => $this->request->getPost('title'),
                    'category' => $this->request->getPost('category'),
                    'description' => $this->request->getPost('description'),
                    'price' => $this->request->getPost('price'),
                    'itinerary' => $this->request->getPost('itinerary'),
                    'image' => $this->request->getPost('image'),
                    'duration' => $this->request->getPost('duration'),
                    'max_people' => $this->request->getPost('max_people'),
                ];

                if ($tourModel->update($id, $data)) {
                    return redirect()->to('/admin')->with('success', 'Tour updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Failed to update tour.');
                }
            } else {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
        }

        $data = [
            'title' => 'Edit Tour - Admin',
            'tour' => $tour
        ];

        return view('admin/edit_tour', $data);
    }

    public function deleteTour($id)
    {
        // Check if user is logged in
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/auth/login')->with('error', 'Please login to access admin area.');
        }

        $tourModel = new TourModel();
        $tour = $tourModel->find($id);

        if (!$tour) {
            return redirect()->to('/admin')->with('error', 'Tour not found.');
        }

        if ($tourModel->delete($id)) {
            return redirect()->to('/admin')->with('success', 'Tour deleted successfully!');
        } else {
            return redirect()->to('/admin')->with('error', 'Failed to delete tour.');
        }
    }
}