<?php

namespace App\Controllers;

use App\Models\TourModel;
use App\Models\ReviewModel;
use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        $tourModel = new TourModel();
        $reviewModel = new ReviewModel();

        $data = [
            'tours' => $tourModel->getTours(), // All tours
            'reviews' => $reviewModel->findAll(5), // Latest 5 reviews
            'categories' => ['All', 'Safari', 'Kilimanjaro'],
            'achievements' => ['World Travel Awards 2025', 'B Corp Certified'],
            'impact' => ['Trees Planted: 15,300+', 'Jobs Created: 250+'],
        ];

        return view('home', $data);
    }
}