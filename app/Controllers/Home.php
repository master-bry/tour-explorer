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
            'tours' => $tourModel->getFeaturedTours(6), // Latest 6 tours
            'reviews' => $reviewModel->orderBy('created_at', 'DESC')->findAll(6), // Latest 6 reviews
            'categories' => ['Safari', 'Kilimanjaro', 'Zanzibar', 'Cultural'],
            'achievements' => ['World Travel Awards 2025', 'B Corp Certified', 'Sustainable Tourism Award'],
            'impact' => ['Trees Planted: 15,300+', 'Jobs Created: 250+', 'Communities Supported: 12+'],
        ];

        return view('home', $data);
    }
}