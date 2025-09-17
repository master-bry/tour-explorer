<?php

namespace App\Controllers;

use App\Models\TourModel;
use App\Models\ReviewModel;
use CodeIgniter\Controller;

class Admin extends Controller
{
    public function index()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/auth/login');
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
        if ($this->request->getMethod() === 'post') {
            $tourModel = new TourModel();
            $tourModel->insert($this->request->getPost());
            return redirect()->to('/admin');
        }
        return view('admin/add_tour');
    }
}